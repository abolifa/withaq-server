<?php

namespace App\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'address',
    ];

    public function lettersOfCredit(): HasMany
    {
        return $this->hasMany(LetterOfCredit::class);
    }

    public function outgoings(): HasMany
    {
        return $this->hasMany(Outgoing::class, 'to_contact_id');
    }

    public function incomings(): HasMany
    {
        return $this->hasMany(Incoming::class, 'from_contact_id');
    }
}
