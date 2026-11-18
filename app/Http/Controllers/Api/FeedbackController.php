<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with(['category', 'tags'])->latest();

        if ($request->filled('status')) {
            $query->status($request->input('status'));
        }

        if ($request->filled('priority')) {
            $query->priority($request->input('priority'));
        }

        return FeedbackResource::collection($query->paginate(10));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'  => 'nullable|exists:categories,id',
            'name'         => 'required|string|min:2|max:50',
            'email'        => 'required|email|max:255',
            'message'      => 'required|string|min:3|max:1000',
            'priority'     => 'required|in:low,medium,high',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $feedback = Feedback::create($validated);

        if (!empty($validated['tags'])) {
            $feedback->tags()->sync($validated['tags']);
        }

        return new FeedbackResource($feedback->load(['category', 'tags']));
    }

    public function show(Feedback $feedback)
    {
        return new FeedbackResource($feedback->load(['category', 'tags', 'notes']));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'category_id'  => 'nullable|exists:categories,id',
            'name'         => 'sometimes|string|min:2|max:50',
            'email'        => 'sometimes|email|max:255',
            'message'      => 'sometimes|string|min:3|max:1000',
            'status'       => 'sometimes|in:new,in_progress,done',
            'priority'     => 'required|in:low,medium,high',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $feedback->update($validated);

        if (array_key_exists('tags', $validated)) {
            $feedback->tags()->sync($validated['tags'] ?? []);
        }

        return new FeedbackResource($feedback->load(['category', 'tags']));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return response()->json(['message' => 'Запись перемещена в корзину']);
    }
}