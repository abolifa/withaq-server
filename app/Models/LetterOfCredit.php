<?php

namespace App\Models;

use Database\Factories\LetterOfCreditFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LetterOfCredit extends Model
{
    /** @use HasFactory<LetterOfCreditFactory> */
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bank_account_id',
        'contact_id',
        'lc_number',
        'issue_date',
        'expiry_date',
        'status',
        'amount',
        'currency',
        'beneficiary',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
