<?php

namespace App\Models;

use Database\Factories\TemplateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    /** @use HasFactory<TemplateFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'greeting',
        'closing',
        'position',
        'commissioner',
        'signature',
        'stamp',
        'show_position',
        'show_commissioner',
        'show_signature',
        'show_stamp',
    ];

    protected $casts = [
        'show_position' => 'boolean',
        'show_commissioner' => 'boolean',
        'show_signature' => 'boolean',
        'show_stamp' => 'boolean',
    ];

    public function outgoings(): HasMany
    {
        return $this->hasMany(Outgoing::class);
    }
}
