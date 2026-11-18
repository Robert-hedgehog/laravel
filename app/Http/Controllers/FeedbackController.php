<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Tag;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('feedback.create', compact('categories', 'tags'));
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
        ], [
            'name.required'    => 'Поле "Имя" обязательно для заполнения.',
            'name.min'         => 'Имя должно содержать минимум 2 символа.',
            'email.required'   => 'Поле "Email" обязательно для заполнения.',
            'email.email'      => 'Введите корректный email-адрес.',
            'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'message.min'      => 'Сообщение должно содержать минимум 3 символа.',
        ]);

        $feedback = Feedback::create($validated);

        if (!empty($validated['tags'])) {
            $feedback->tags()->sync($validated['tags']);
        }

        return redirect()->route('feedback.create')->with('success', 'Данные успешно сохранены в базу данных!');
    }

    public function index(Request $request)
    {
        $query = Feedback::with(['category', 'tags'])->latest();

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('status')) {
            $query->status($request->input('status'));
        }

        if ($request->filled('category_id')) {
            $query->byCategory((int) $request->input('category_id'));
        }

        if ($request->filled('priority')) {
            $query->priority($request->input('priority'));
        }

        $feedbacks = $query->get();
        $categories = Category::all();

        return view('feedback.index', compact('feedbacks', 'categories'));
    }

    public function show(Feedback $feedback)
    {
        $feedback->load(['category', 'tags', 'notes']);

        return view('feedback.show', compact('feedback'));
    }

    public function edit(Feedback $feedback)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('feedback.edit', compact('feedback', 'categories', 'tags'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'category_id'  => 'nullable|exists:categories,id',
            'name'         => 'required|string|min:2|max:50',
            'email'        => 'required|email|max:255',
            'message'      => 'required|string|min:3|max:1000',
            'status'       => 'required|in:new,in_progress,done',
            'priority'     => 'required|in:low,medium,high',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $feedback->update($validated);
        $feedback->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('feedback.show', $feedback)->with('success', 'Запись успешно обновлена!');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Запись перемещена в корзину.');
    }

    public function restore(int $id)
    {
        $feedback = Feedback::onlyTrashed()->findOrFail($id);
        $feedback->restore();

        return redirect()->route('feedback.index', ['trashed' => 1])->with('success', 'Запись восстановлена.');
    }

    public function forceDelete(int $id)
    {
        $feedback = Feedback::onlyTrashed()->findOrFail($id);
        $feedback->forceDelete();

        return redirect()->route('feedback.index', ['trashed' => 1])->with('success', 'Запись удалена навсегда.');
    }

    public function storeNote(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'body' => 'required|string|min:2|max:500',
        ]);

        $feedback->notes()->create($validated);

        return redirect()->route('feedback.show', $feedback)->with('success', 'Заметка добавлена.');
    }
}