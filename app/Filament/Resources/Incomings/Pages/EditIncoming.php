<?php

namespace App\Filament\Resources\Incomings\Pages;

use App\Filament\Resources\Incomings\IncomingResource;
use App\Services\AttachmentService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EditIncoming extends EditRecord
{
    protected static string $resource = IncomingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
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

            if ($record->document_path) {
                Storage::disk('public')->delete($record->document_path);
            }

            $service = app(AttachmentService::class);
            $merged = $service->buildMergedPdf(
                $record->attachments ?? [],
                $record->id,
                outputFolder: 'incomings',
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
