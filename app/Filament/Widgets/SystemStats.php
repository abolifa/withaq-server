<?php

namespace App\Filament\Widgets;

use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Document;
use App\Models\Incoming;
use App\Models\LetterOfCredit;
use App\Models\Outgoing;
use Filament\Widgets\StatsOverviewWidget;

class SystemStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $companies = Company::count();
        $documents = Document::count();
        $outgoings = Outgoing::count();
        $incomings = Incoming::count();
        $accounts = BankAccount::count();
        $lcs = LetterOfCredit::count();
        return [
            StatsOverviewWidget\Stat::make('الشركات', $companies)
                ->description('إجمالي الشركات')
                ->icon('heroicon-o-building-office')
                ->url(fn() => route('filament.admin.resources.companies.index'))
                ->color('cyan'),
            StatsOverviewWidget\Stat::make('المستندات', $documents)
                ->description('إجمالي المستندات')
                ->icon('heroicon-o-document-text')
                ->url(fn() => route('filament.admin.resources.documents.index'))
                ->color('success'),
            StatsOverviewWidget\Stat::make('الحسابات المصرفية', $accounts)
                ->description('إجمالي الحسابات المصرفية')
                ->icon('heroicon-o-banknotes')
                ->url(fn() => route('filament.admin.resources.bank-accounts.index'))
                ->color('info'),
            StatsOverviewWidget\Stat::make('الصادر', $outgoings)
                ->description('إجمالي البريد الصادر')
                ->icon('heroicon-o-arrow-up-tray')
                ->url(fn() => route('filament.admin.resources.outgoings.index'))
                ->color('warning'),
            StatsOverviewWidget\Stat::make('الوارد', $incomings)
                ->description('إجمالي البريد الوارد')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn() => route('filament.admin.resources.incomings.index'))
                ->color('indigo'),
            StatsOverviewWidget\Stat::make('خطابات الاعتماد', $lcs)
                ->description('إجمالي خطابات الاعتماد')
                ->icon('heroicon-o-document-duplicate')
                ->url(fn() => route('filament.admin.resources.letter-of-credits.index'))
                ->color('rose'),
        ];
    }
}
