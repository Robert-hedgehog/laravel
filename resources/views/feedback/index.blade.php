@extends('layouts.app')

@section('title', 'Таблица записей')

@section('content')
<div class="card card-full">
    <h2>Все сохраненные записи ({{ count($feedbacks) }})</h2>

    <table style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Имя</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 35%;">Сообщение</th>
                <th style="width: 20%;">Дата</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ $item['name'] ?? '' }}</b></td>
                    <td style="word-break: break-word;">{{ $item['email'] ?? '' }}</td>
                    <td style="word-break: break-word;">{{ $item['message'] ?? '' }}</td>
                    <td style="color: #6b7280; font-size: 13px;">{{ $item['created_at'] ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #9ca3af; padding: 20px;">
                        Данных пока нет.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection