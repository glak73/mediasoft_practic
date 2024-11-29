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

                <a href="{{ route('checklist.index') }}" class="btn btn-secondary">Вернуться к списку</a>
                @if ($errors->any)
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Форма для добавления нового пункта -->
                <form id="add-action-form" method="POST" action="{{ route('checklist.update', ['checklist' => $checklist->id]) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="checklist" value="{{ $checklist->id }}">
                    <div class="mb-3">
                        <label for="action-name" class="form-label">Название действия</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_completed" name="is_completed">
                        <label class="form-check-label" for="is_completed">
                            Выполнено
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить действие</button>
                </form>

            </div>
        </div>
    </div>
@endsection
