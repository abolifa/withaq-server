<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelpers;
use App\Models\Outgoing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OutgoingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Outgoing::query()
            ->with(['company:id,name', 'contact:id,name'])
            ->select('id', 'company_id', 'to_contact_id', 'issue_number', 'issue_date', 'subject', 'document_path', 'to', 'cc', 'created_at');
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                    ->orWhere('to', 'like', "%$search%")
                    ->orWhere('cc', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%")
                    ->orWhereHas('company', fn($c) => $c->where('name', 'like', "%$search%"))
                    ->orWhereHas('contact', fn($c) => $c->where('name', 'like', "%$search%"));
            });
        }

        if ($companyId = $request->input('company_id')) {
            $query->where('company_id', $companyId);
        }
        if ($from = $request->input('date_from')) {
            $query->whereDate('issue_date', '>=', $from);
        }
        if ($to = $request->input('date_to')) {
            $query->whereDate('issue_date', '<=', $to);
        }
        $sortBy = $request->input('sort_by', 'issue_date');
        $sortDir = $request->input('sort_dir', 'desc');
        if (in_array($sortBy, ['issue_date', 'issue_number', 'subject']) &&
            in_array(strtolower($sortDir), ['asc', 'desc'])) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('issue_date', 'desc');
        }
        $perPage = (int)$request->input('per_page', 10);
        $outgoings = $query->paginate($perPage);
        return response()->json($outgoings);
    }

    public function show(Outgoing $outgoing): JsonResponse
    {
        $outgoing->load(['company:id,name', 'contact:id,name', 'template:id,name']);
        return response()->json($outgoing);
    }

    /**
     * Store a new outgoing
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'issue_date' => ['required', 'date'],
            'to_contact_id' => ['nullable', 'integer', 'exists:contacts,id'],
            'template_id' => ['nullable', 'integer', 'exists:templates,id'],
            'to' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
//            'cc' => ['nullable', 'array'],
            'body' => ['nullable', 'string'],
            'attachments.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $validated['issue_number'] = CommonHelpers::getIssueNumber(new Outgoing());
        $validated['qr_code'] = CommonHelpers::buildOutgoingQrPayload($validated['issue_number']);

        $paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('outgoings/attachments', 'public');
            }
        }
        $validated['attachments'] = $paths;

        $outgoing = Outgoing::create($validated);

        $outgoing->generatePdf();


        return response()->json(['success' => true, 'id' => $outgoing->id]);
    }


    /**
     * Update outgoing
     */
    public function update(Request $request, Outgoing $outgoing): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => ['sometimes', 'nullable', 'integer', 'exists:companies,id'],
            'issue_number' => ['sometimes', 'string', 'max:255', 'unique:outgoings,issue_number,' . $outgoing->id],
            'issue_date' => ['sometimes', 'date'],
            'to_contact_id' => ['sometimes', 'nullable', 'integer', 'exists:contacts,id'],
            'template_id' => ['sometimes', 'nullable', 'integer', 'exists:templates,id'],
            'to' => ['sometimes', 'nullable', 'string', 'max:255'],
            'subject' => ['sometimes', 'nullable', 'string', 'max:255'],
            'cc' => ['sometimes', 'nullable', 'array'],
            'body' => ['sometimes', 'nullable', 'string'],
            'attachments' => ['sometimes', 'nullable', 'array'],
            'attachments.*' => ['string'],
        ]);

        $outgoing->update($validated);

        return response()->json(['success' => true]);
    }

    /**
     * Delete outgoing
     */
    public function destroy(Outgoing $outgoing): JsonResponse
    {
        $outgoing->delete();
        return response()->json(['success' => true]);
    }
}
