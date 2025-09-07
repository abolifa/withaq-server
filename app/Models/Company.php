<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'english_name',
        'phone',
        'email',
        'website',
        'address',
        'ceo',
        'members',
        'letterhead',
        'logo',
    ];

    protected $casts = [
        'members' => 'array',
    ];

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function lettersOfCredit(): HasMany
    {
        return $this->hasMany(LetterOfCredit::class);
    }

    public function outgoings(): HasMany
    {
        return $this->hasMany(Outgoing::class);
    }
}

