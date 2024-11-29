@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="card-header">Создание нового чек-листа</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('checklist.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Название чек-листа:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Создать чек-лист</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
