@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="hero">
        <h1>Веб-приложение на Laravel</h1>
        <p>Основа приложения: обработка запросов, валидация данных и файловое хранилище.</p>
        <div>
            <a href="{{ route('feedback.create') }}" class="btn btn-primary">Заполнить форму</a>
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Посмотреть записи</a>
        </div>
    </div>
@endsection