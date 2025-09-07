<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\AttachmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * List documents for a specific company
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => 'required|integer|exists:companies,id',
        ]);

        $documents = Document::where('company_id', $validated['company_id'])
            ->select('id', 'company_id', 'type', 'issue_date', 'expiry_date', 'number', 'notes')
            ->latest('issue_date')
            ->get();
        return response()->json($documents);
    }

    /**
     * Show a single document
     */
    public function show(Document $document): JsonResponse
    {
        return response()->json([
            'success' => true,
            'document' => $document,
        ]);
    }

    /**
     * Store a new document
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => 'required|integer|exists:companies,id',
            'type' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'number' => 'nullable|string|max:255',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'notes' => 'nullable|string',
        ]);

        $paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('documents/attachments', 'public');
            }
            $validated['attachments'] = $paths;
        }

        $document = Document::create($validated);

        if (!empty($paths)) {
            $service = app(AttachmentService::class);
            $mergedPath = $service->buildMergedPdf($paths, $document->id, 'documents');
            if ($mergedPath) {
                $document->update(['document_path' => $mergedPath]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update an existing document
     */
    public function update(Request $request, Document $document): JsonResponse
    {
        $validated = $request->validate([
            'company_id' => ['sometimes', 'integer', 'exists:companies,id'],
            'type' => ['sometimes', 'string', 'max:255'],
            'issue_date' => ['sometimes', 'date'],
            'expiry_date' => ['sometimes', 'date', 'after_or_equal:issue_date'],
            'number' => ['sometimes', 'string', 'max:255'],
            'attachments.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'existing_attachments' => ['nullable', 'array'],
            'existing_attachments.*' => ['string'],
            'notes' => ['nullable', 'string'],
        ]);

        $paths = $validated['existing_attachments'] ?? [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('documents/attachments', 'public');
            }
        }

        $validated['attachments'] = $paths;

        $document->update($validated);

        if (!empty($paths)) {
            $service = app(AttachmentService::class);
            $mergedPath = $service->buildMergedPdf($paths, $document->id, 'documents');
            if ($mergedPath) {
                $document->update(['document_path' => $mergedPath]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Document updated successfully',
            'document' => $document,
        ]);
    }


    /**
     * Delete a document
     */
    public function destroy(Document $document): JsonResponse
    {
        $document->delete();

        return response()->json([
            'success' => true,
            'message' => 'Document deleted successfully',
        ]);
    }
}
