@extends('layouts.app')

@section('content')
    Вы вошли в систему
    @if (isset($users))
        <h2>Список пользователей:</h2>

        <div id="user-list">
            @foreach ($users as $user)
                <div class="user-item">
                    <p>{{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <p>Роль: {{ $user->role }}</p>
                    <p>Активен: {{ $user->is_active ? 'Да' : 'Нет' }}</p>

                    @if (auth()->user()->role === 'super_admin')
                        <form action="{{ route('users.update-checklist-limit', ['id' => $user->id]) }}" method="POST"
                            style="display:inline;">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <label for="checklists_limit">Обновить лимит чеклистов:</label>
                            <input type="number" id="checklists_limit" name="checklists_limit"
                                value="{{ $user->checklists_limit }}" style="width:60px;">
                            <button type="submit" class="btn btn-info">Обновить</button>
                        </form>

                        <form method="POST" action="{{ route('users.assign-admin', ['id' => $user->id]) }}"
                            style="display:inline;">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-success">Назначить администратором</button>
                        </form>
                        <form method="POST" action="{{ route('users.block', ['id' => $user->id]) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Заблокировать</button>
                        </form>

                        <form method="POST" action="{{ route('users.unblock', ['id' => $user->id]) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Разблокировать</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('users.block', ['id' => $user->id]) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Заблокировать</button>
                        </form>

                        <form method="POST" action="{{ route('users.unblock', ['id' => $user->id]) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Разблокировать</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
@endsection
