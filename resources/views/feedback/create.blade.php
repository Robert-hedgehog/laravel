@extends('layouts.app')

@section('title', 'Форма обратной связи')

@section('content')
<div class="card">
    <h2>Форма обратной связи</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <form action="{{ route('feedback.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id" style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                <option value="">Без категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="@error('name') error @enderror">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="@error('email') error @enderror">
        </div>

        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea name="message" id="message" rows="4" class="@error('message') error @enderror">{{ old('message') }}</textarea>
        </div>

        <div class="form-group">
            <label>Приоритет:</label>
            <label style="display: inline-block; margin-right: 12px; font-weight: normal;">
                <input type="radio" name="priority" value="low" @checked(old('priority', 'medium') === 'low')> Низкий
            </label>
            <label style="display: inline-block; margin-right: 12px; font-weight: normal;">
                <input type="radio" name="priority" value="medium" @checked(old('priority', 'medium') === 'medium')> Средний
            </label>
            <label style="display: inline-block; font-weight: normal;">
                <input type="radio" name="priority" value="high" @checked(old('priority', 'medium') === 'high')> Высокий
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Отправить</button>
    </form>
</div>
@endsection