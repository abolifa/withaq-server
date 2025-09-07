<?php

namespace App\Models;

use Database\Factories\OutgoingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Throwable;

class Outgoing extends Model
{
    /** @use HasFactory<OutgoingFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'issue_number',
        'issue_date',
        'qr_code',
        'to_contact_id',
        'template_id',
        'to',
        'subject',
        'cc',
        'body',
        'attachments',
        'document_path',
    ];

    protected $casts = [
        'cc' => 'array',
        'attachments' => 'array',
        'issue_date' => 'date',
    ];

//    protected static function booted(): void
//    {
//        static::created(function (Outgoing $outgoing) {
//            $outgoing->generatePdf();
//        });
//
//        static::updated(function (Outgoing $outgoing) {
//            $outgoing->generatePdf();
//        });
//    }

    public function generatePdf(): void
    {
        try {
            if ($this->document_path && Storage::disk('public')->exists($this->document_path)) {
                Storage::disk('public')->delete($this->document_path);
            }
            $fileName = "outgoings/outgoing_$this->id.pdf";
            $html = View::make('print.outgoing', ['record' => $this])->render();
            $config = [
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_top' => 50,
                'margin_right' => 20,
                'margin_bottom' => 20,
                'margin_left' => 20,
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'dpi' => 150,
                'tempDir' => storage_path('app/mpdf_temp'),

            ];
            $mpdf = new Mpdf($config);
            if ($this->company && $this->company->letterhead) {
                $letterheadPath = Storage::disk('public')->path($this->company->letterhead);
                if (file_exists($letterheadPath)) {
                    $mpdf->SetWatermarkImage($letterheadPath, 1.0, 'P', 'B');
                    $mpdf->showWatermarkImage = true;
                    $mpdf->watermarkImgBehind = true;
                }
            }
            $mpdf->SetHTMLFooter('
        <div style="text-align: center; font-size: 10pt;">
            صفحة {PAGENO} من {nb}
        </div>
    ');
            $mpdf->WriteHTML($html);
            Storage::disk('public')->put($fileName, $mpdf->Output('', 'S'));
            $this->updateQuietly(['document_path' => $fileName]);
        } catch (Throwable $e) {
            Log::error('Failed to generate PDF for Outgoing ID ' . $this->id . ': ' . $e->getMessage());
        }
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'to_contact_id');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function incomings(): HasMany
    {
        return $this->hasMany(Incoming::class, 'follow_up_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
