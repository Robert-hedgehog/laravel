@extends('layouts.app')

@section('title', 'Запись #' . $feedback->id)

@section('content')
<div class="card card-full">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h2 style="margin-bottom: 0;">Обращение #{{ $feedback->id }}</h2>
        <div>
            <a href="{{ route('feedback.edit', $feedback) }}" class="btn btn-secondary btn-sm">Редактировать</a>
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary btn-sm">Назад к таблице</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <p><b>Имя:</b> {{ $feedback->name }}</p>
    <p><b>Email:</b> {{ $feedback->email }}</p>
    <p><b>Категория:</b> {{ $feedback->category?->name ?? 'Без категории' }}</p>
    <p><b>Статус:</b> {{ $feedback->status }}</p>
    <p><b>Приоритет:</b> {{ $feedback->priority }}</p>
    <p style="margin: 10px 0;"><b>Сообщение:</b><br>{{ $feedback->message }}</p>

    <div style="margin-bottom: 20px;">
        <b>Теги:</b>
        @forelse($feedback->tags as $tag)
            <span class="badge">{{ $tag->name }}</span>
        @empty
            <span style="color: #9ca3af;">Нет тегов</span>
        @endforelse
    </div>

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">

    <h3>Заметки</h3>
    <ul style="margin: 10px 0 15px 20px;">
        @forelse($feedback->notes as $note)
            <li style="margin-bottom: 6px;">
                {{ $note->body }}
                <small style="color: #6b7280;">({{ $note->created_at->format('d.m.Y H:i') }})</small>
            </li>
        @empty
            <li style="color: #9ca3af;">Заметок пока нет.</li>
        @endforelse
    </ul>

    <form action="{{ route('feedback.notes.store', $feedback) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="body">Добавить заметку:</label>
            <textarea name="body" id="body" rows="2" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Сохранить заметку</button>
    </form>
</div>
@endsection