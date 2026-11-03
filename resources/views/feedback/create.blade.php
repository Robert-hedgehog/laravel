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

        <button type="submit" class="btn btn-primary" style="width: 100%;">Отправить</button>
    </form>
</div>
@endsection