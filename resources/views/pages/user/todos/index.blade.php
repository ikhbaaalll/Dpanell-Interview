@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Todo List') }}
        </div>

        @if (session('status'))
            <div class="alert alert-info" role="alert">{{ session('status') }}</div>
        @endif

        <div class="card-body">
            <a href="{{ route('todos.create') }}" class="btn btn-sm btn-success text-white">Add new todo list</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Start At</th>
                        <th scope="col">End At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $todo->name }}</td>
                            <td>{{ Illuminate\Support\Str::limit($todo->description, 15, '...') }}</td>
                            <td>{{ $todo->start_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $todo->end_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if ($todo->status == '0')
                                    <span class="bg-info rounded p-1 text-white">Done</span>
                                @else
                                    <span class="bg-success rounded p-1 text-white">Ongoing</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger text-white" data-coreui-toggle="modal"
                                    data-coreui-target="#deleteModal">Delete</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Todo</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Delete this todo list?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-coreui-dismiss="modal">Close</button>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $todos->links() }}
        </div>
    </div>
@endsection
