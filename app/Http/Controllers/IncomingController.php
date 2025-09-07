<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Incoming::query()
            ->with(['contact:id,name', 'followUp:id,issue_number,subject'])
            ->select(
                'id',
                'issue_number',
                'issue_date',
                'from_contact_id',
                'from',
                'follow_up_id',
                'document_path',
                'attachments',
                'created_at'
            );

        // 🔍 Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('issue_number', 'like', "%$search%")
                    ->orWhere('from', 'like', "%$search%")
                    ->orWhereHas('contact', fn($c) => $c->where('name', 'like', "%$search%"))
                    ->orWhereHas('followUp', fn($f) => $f->where('subject', 'like', "%$search%"));
            });
        }

        // 📅 Date range filters
        if ($from = $request->input('date_from')) {
            $query->whereDate('issue_date', '>=', $from);
        }
        if ($to = $request->input('date_to')) {
            $query->whereDate('issue_date', '<=', $to);
        }

        // 🔽 Sorting
        $sortBy = $request->input('sort_by', 'issue_date');
        $sortDir = $request->input('sort_dir', 'desc');
        if (
            in_array($sortBy, ['issue_date', 'issue_number', 'from']) &&
            in_array(strtolower($sortDir), ['asc', 'desc'])
        ) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('issue_date', 'desc');
        }

        // 📄 Pagination
        $perPage = (int)$request->input('per_page', 10);
        $incomings = $query->paginate($perPage);

        return response()->json($incomings);
    }
}
