<?php

namespace App\Models;

use Database\Factories\IncomingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incoming extends Model
{
    /** @use HasFactory<IncomingFactory> */
    use HasFactory;

    protected $fillable = [
        'issue_number',
        'issue_date',
        'from_contact_id',
        'from',
        'follow_up_id',
        'attachments',
        'document_path',
    ];

    protected $casts = [
        'attachments' => 'array',
        'issue_date' => 'date',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'from_contact_id');
    }

    public function followUp(): BelongsTo
    {
        return $this->belongsTo(Outgoing::class, 'follow_up_id');
    }
}
