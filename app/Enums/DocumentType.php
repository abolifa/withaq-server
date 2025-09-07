<?php

namespace App\Enums;

class DocumentType
{
    public static function label(string $value): string
    {
        return self::options()[$value] ?? $value;
    }

    public static function options(): array
    {
        return [
            'commercial_register' => 'السجل التجاري',
            'trading_license' => 'الرخصة التجارية',
            'tax_registration' => 'شهادة سداد ضريبي',
            'import_register' => 'سجل مستوردين',
            'industrial_register' => 'سجل صناعي',
            'industrial_license' => 'رخصة صناعية',
            'statistical_code' => 'رمز إحصائي',
            'cbl_certificate' => 'شهادة cbl',
            'social_security_certificate' => 'شهادة سداد اشتراكات ضمانية',
            'solidarity_certificate' => 'شهادة تضامن',
            'articles_of_association' => 'النظام الأساسي',
            'foundation_contract' => 'عقد التأسيس',
            'amendment_contract' => 'عقد التعديل',
            'general_assembly_minutes' => 'محضر إجتماع الجمعية العمومية',
        ];
    }

    public static function color(string $value): string
    {
        return self::colors()[$value] ?? 'gray';
    }

    public static function colors(): array
    {
        return [
            'commercial_register' => 'rose',
            'trading_license' => 'success',
            'tax_registration' => 'warning',
            'import_register' => 'info',
            'industrial_register' => 'danger',
            'industrial_license' => 'fuchsia',
            'statistical_code' => 'indigo',
            'cbl_certificate' => 'cyan',
            'social_security_certificate' => 'purple',
            'solidarity_certificate' => 'amber',
            'articles_of_association' => 'lime',
            'foundation_contract' => 'teal',
            'amendment_contract' => 'emerald',
            'general_assembly_minutes' => 'cyan',
        ];
    }
}
