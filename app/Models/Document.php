<?php

namespace App\Models;

use Database\Factories\DocumentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    /** @use HasFactory<DocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'type',
        'issue_date',
        'expiry_date',
        'number',
        'attachments',
        'notes',
        'document_path',
    ];

    protected $casts = [
        'attachments' => 'array',
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
