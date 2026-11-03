<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:2|max:50',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:3|max:1000',
        ], [
            'name.required'    => 'Поле "Имя" обязательно для заполнения.',
            'name.min'         => 'Имя должно содержать минимум 2 символа.',
            'email.required'   => 'Поле "Email" обязательно для заполнения.',
            'email.email'      => 'Введите корректный email-адрес.',
            'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'message.min'      => 'Сообщение должно содержать минимум 10 символов.',
        ]);

        $validated['created_at'] = now()->format('Y-m-d H:i:s');
        $fileName = 'feedback_' . now()->format('Ymd_His') . '_' . Str::random(6) . '.json';

        Storage::disk('local')->put(
            'feedback/' . $fileName,
            json_encode($validated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        return redirect()->route('feedback.create')->with('success', 'Данные успешно сохранены в JSON-файл!');
    }

    public function index()
    {
        $feedbacks = [];
        $files = Storage::disk('local')->files('feedback');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = Storage::disk('local')->get($file);
                $data = json_decode($content, true);
                if ($data) {
                    $feedbacks[] = $data;
                }
            }
        }

        usort($feedbacks, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));

        return view('feedback.index', compact('feedbacks'));
    }
}