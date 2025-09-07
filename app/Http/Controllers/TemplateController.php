<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\JsonResponse;

class TemplateController extends Controller
{
    public function getTemplates(): JsonResponse
    {
        $contacts = Template::select('id', 'name')->orderBy('name')->get();
        return response()->json($contacts);
    }
}
