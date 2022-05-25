@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            New Todo List
        </div>

        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                        value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="start_at" class="form-label">Start At</label>
                    <input type="datetime-local" class="form-control" id="start_at" placeholder="Start At" name="start_at"
                        value="{{ old('start_at') }}" required>
                </div>
                <div class="mb-3">
                    <label for="end_at" class="form-label">End At</label>
                    <input type="datetime-local" class="form-control" id="end_at" placeholder="End At" name="end_at"
                        value="{{ old('end_at') }}" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>

        </form>

    </div>
@endsection
