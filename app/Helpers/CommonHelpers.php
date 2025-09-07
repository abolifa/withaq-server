<?php

namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CommonHelpers
{
    public static function getIssueNumber(Model $model): string
    {
        $currentYear = Carbon::now()->year;
        $latest = $model->newQuery()->latest()->value('issue_number');
        if (is_string($latest) && preg_match('/^(\d+)-(\d{4})$/', $latest, $m)) {
            [$full, $num, $year] = $m;
            $num = (int)$num;
            $year = (int)$year;
            if ($year === $currentYear) {
                return ($num + 1) . '-' . $currentYear;
            }
        }
        return '1-' . $currentYear;
    }

    public static function buildOutgoingQrPayload(string $issue): string
    {
        return url('/outgoings/verify/' . $issue);
    }


}
