@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Просмотр чеклиста</h1>

        <div class="card">
            <div class="card-body">
                <h2>{{ $checklist->title }}</h2>

                <p><strong>Описание:</strong></p>
                <pre>{{ $checklist->description }}</pre>

                <hr>

                <h3>Действия:</h3>
                <ul>
                    @foreach($checklist->actions as $action)
                        <li>{{ $action->name }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('checklist.edit', $checklist->id) }}">редактировать чеклист</a>
                <a href="{{ route('checklist.index') }}" class="btn btn-secondary">Вернуться к списку</a>
            </div>
        </div>
    </div>
@endsection
