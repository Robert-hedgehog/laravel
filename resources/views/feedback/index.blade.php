@extends('layouts.app')

@section('title', 'Таблица записей')

@section('content')
<div class="card card-full">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <h2>{{ request()->boolean('trashed') ? 'Корзина' : 'Все сохраненные записи' }} ({{ count($feedbacks) }})</h2>
        @if(request()->boolean('trashed'))
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary btn-sm">Активные записи</a>
        @else
            <a href="{{ route('feedback.index', ['trashed' => 1]) }}" class="btn btn-secondary btn-sm">Корзина</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('feedback.index') }}" class="filters">
        @if(request()->boolean('trashed'))
            <input type="hidden" name="trashed" value="1">
        @endif

        <select name="category_id">
            <option value="">Все категории</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Все статусы</option>
            <option value="new" @selected(request('status') === 'new')>Новое</option>
            <option value="in_progress" @selected(request('status') === 'in_progress')>В работе</option>
            <option value="done" @selected(request('status') === 'done')>Выполнено</option>
        </select>

        <select name="priority">
            <option value="">Все приоритеты</option>
            <option value="low" @selected(request('priority') === 'low')>Низкий</option>
            <option value="medium" @selected(request('priority') === 'medium')>Средний</option>
            <option value="high" @selected(request('priority') === 'high')>Высокий</option>
        </select>

        <button type="submit" class="btn btn-secondary btn-sm">Фильтровать</button>
        <a href="{{ request()->boolean('trashed') ? route('feedback.index', ['trashed' => 1]) : route('feedback.index') }}" class="btn btn-secondary btn-sm">Сбросить</a>
    </form>

    <table style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 20%;">Имя</th>
                <th style="width: 18%;">Email</th>
                <th style="width: 20%;">Сообщение</th>
                <th style="width: 12%;">Дата</th>
                <th style="width: 25%;">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="word-break: break-word;">
                        <b>{{ $item->name }}</b>
                        @if($item->priority === 'high')
                            <div style="margin-top: 5px;">
                                <span class="badge badge-important">Высокий</span>
                            </div>
                        @endif
                    </td>
                    <td style="word-break: break-word;">{{ $item->email }}</td>
                    <td style="word-break: break-word;">
                        {{ $item->message }}
                        <div style="margin-top: 5px; font-size: 12px; color: #6b7280;">
                            {{ $item->category?->name ?? 'Без категории' }} · {{ $item->status }}
                        </div>
                        @if($item->tags->isNotEmpty())
                            <div style="margin-top: 5px;">
                                @foreach($item->tags as $tag)
                                    <span class="badge">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td style="color: #6b7280; font-size: 13px;">{{ $item->created_at?->format('Y-m-d H:i') }}</td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            @if($item->trashed())
                                <form action="{{ route('feedback.restore', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm" style="margin-left: 0;">Восстановить</button>
                                </form>
                                <form action="{{ route('feedback.force-delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            @else
                                <a href="{{ route('feedback.show', $item) }}" class="btn btn-secondary btn-sm" style="margin-left: 0;">Открыть</a>
                                <form action="{{ route('feedback.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #9ca3af; padding: 20px;">
                        Данных пока нет.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection