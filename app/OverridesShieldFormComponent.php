<?php

namespace App;

use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents as ShieldBase;
use Filament\Schemas\Components\Component;
use Illuminate\Support\Str;

trait OverridesShieldFormComponent
{
    use ShieldBase {
        ShieldBase::getCheckboxListFormComponent as protected baseGetCheckboxListFormComponent;
    }

    public static function getCheckboxListFormComponent(
        string                $name,
        array                 $options,
        bool                  $searchable = true,
        array|int|string|null $columns = null,
        array|int|string|null $columnSpan = null
    ): Component
    {
        $options = collect($options)->mapWithKeys(function ($label, $permission) {
            [$prefix, $subject] = explode(':', $permission);

            // Translate prefix
            $snake = Str::snake(lcfirst($prefix));
            $prefixLabel = __("filament-shield::filament-shield.resource_permission_prefixes_labels.$snake");
            if ($prefixLabel === "filament-shield::filament-shield.resource_permission_prefixes_labels.$snake") {
                $prefixLabel = Str::headline($prefix);
            }

            // Translate model
            $subjectLabel = $subject;
            foreach (FilamentShield::getResources() as $resource) {
                $modelClass = $resource['modelFqcn'];
                if (class_basename($modelClass) === $subject) {
                    // Use the Resource-defined label (Arabic in your case)
                    $subjectLabel = $resource['resourceFqcn']::getModelLabel();
                    break;
                }
            }

            return [$permission => trim("$prefixLabel $subjectLabel")];
        })->toArray();

        return static::baseGetCheckboxListFormComponent(
            $name,
            $options,
            $searchable,
            $columns,
            $columnSpan
        );
    }
}
