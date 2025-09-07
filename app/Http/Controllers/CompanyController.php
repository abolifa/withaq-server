<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanies(Request $request): JsonResponse
    {
        $companies = Company::query()->select('id', 'name', 'ceo', 'english_name', 'logo')->get();
        return response()->json($companies);
    }
}
