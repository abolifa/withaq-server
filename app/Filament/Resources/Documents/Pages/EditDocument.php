<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use App\Services\AttachmentService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    // نخزن المرفقات القديمة هنا
    protected array $originalAttachments = [];

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // خزّن نسخة من المرفقات قبل التعديل
        $this->originalAttachments = (array)($this->record->getOriginal('attachments') ?? []);
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        try {
            $before = json_encode(array_values($this->originalAttachments));
            $after = json_encode(array_values((array)($record->attachments ?? [])));

            if ($before === $after) {
                Notification::make()
                    ->title('تم الحفظ')
                    ->body('لم تتغير المرفقات؛ لا حاجة لإعادة بناء الملف.')
                    ->success()
                    ->send();
                return;
            }

            // لو تغيرت المرفقات نحذف الملف القديم
            if ($record->document_path) {
                Storage::disk('public')->delete($record->document_path);
            }

            // نعيد بناء الملف الجديد
            $service = app(AttachmentService::class);
            $merged = $service->buildMergedPdf(
                $record->attachments ?? [],
                $record->id,
                outputFolder: 'documents',
            );

            $record->update(['document_path' => $merged]);

            Notification::make()
                ->title('تم تحديث الملف المدمج')
                ->body($merged ? 'أُعيد بناء PDF بنجاح.' : 'لا توجد مرفقات صالحة للدمج.')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('فشل تحديث الملف المدمج')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
