<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function getContacts(): JsonResponse
    {
        $contacts = Contact::select('id', 'name')->orderBy('name')->get();
        return response()->json($contacts);
    }
}
