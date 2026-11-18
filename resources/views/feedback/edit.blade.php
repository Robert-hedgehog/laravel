@extends('layouts.app')

@section('title', 'Редактировать запись #' . $feedback->id)

@section('content')
<div class="card">
    <h2>Редактировать запись #{{ $feedback->id }}</h2>

    @if ($errors->any())
        <div class="alert-danger">
            <b>Исправьте следующие ошибки:</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('feedback.update', $feedback) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id" style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                <option value="">Без категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $feedback->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Статус:</label>
            <select name="status" id="status" style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                <option value="new" @selected(old('status', $feedback->status) === 'new')>Новое</option>
                <option value="in_progress" @selected(old('status', $feedback->status) === 'in_progress')>В работе</option>
                <option value="done" @selected(old('status', $feedback->status) === 'done')>Выполнено</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $feedback->name) }}" class="@error('name') error @enderror">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $feedback->email) }}" class="@error('email') error @enderror">
        </div>

        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea name="message" id="message" rows="4" class="@error('message') error @enderror">{{ old('message', $feedback->message) }}</textarea>
        </div>

        <div class="form-group">
            <label>Теги:</label>
            @php $selectedTags = old('tags', $feedback->tags->pluck('id')->all()); @endphp
            @foreach($tags as $tag)
                <label style="display: inline-block; margin-right: 10px; font-weight: normal;">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, $selectedTags))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>

        <div class="form-group">
            <label>Приоритет:</label>
            <label style="display: inline-block; margin-right: 12px; font-weight: normal;">
                <input type="radio" name="priority" value="low" @checked(old('priority', $feedback->priority) === 'low')> Низкий
            </label>
            <label style="display: inline-block; margin-right: 12px; font-weight: normal;">
                <input type="radio" name="priority" value="medium" @checked(old('priority', $feedback->priority) === 'medium')> Средний
            </label>
            <label style="display: inline-block; font-weight: normal;">
                <input type="radio" name="priority" value="high" @checked(old('priority', $feedback->priority) === 'high')> Высокий
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Сохранить изменения</button>
    </form>
</div>
@endsection