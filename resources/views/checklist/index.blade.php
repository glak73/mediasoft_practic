@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список чеклистов</h1>

        <div class="card">
            <div class="card-body">
                <h2>Все чеклисты</h2>

                <ul>
                    @foreach($checklists as $checklist)
                        <li>
                            {{ $checklist->title }}
                            (<a href="{{ route('checklist.show', $checklist->id) }}">Просмотреть</a>)
                            @if(auth()->id() == $checklist->user_id)
                                (<a href="{{ route('checklist.edit', $checklist->id) }}">Редактировать</a>)
                            @endif
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('checklist.create') }}" class="btn btn-primary">Создать новый чеклист</a>
            </div>
        </div>
    </div>
@endsection
