<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TranslatedShield
{
    public static function translatePermissions(array $permissions): array
    {
        $labels = [];

        foreach ($permissions as $permission) {
            [$prefix, $subject] = explode(':', $permission);

            // ترجم الـ prefix من lang
            $prefixLabel = trans("filament-shield::filament-shield.resource_permission_prefixes_labels.$prefix");

            // fallback لو مفيش ترجمة
            if ($prefixLabel === "filament-shield::filament-shield.resource_permission_prefixes_labels.$prefix") {
                $prefixLabel = Str::headline($prefix);
            }

            $labels[$permission] = "$prefixLabel $subject";
        }

        return $labels;
    }
}
