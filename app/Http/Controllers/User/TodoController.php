<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::query()
            ->with('user')
            ->whereBelongsTo(auth()->user())
            ->orderBy('start_at')
            ->paginate(10);

        return view('pages.user.todos.index', compact('todos'));
    }

    public function create()
    {
        return view('pages.user.todos.create');
    }

    public function store(TodoStoreRequest $todoStoreRequest)
    {
        Todo::create($todoStoreRequest->validated() + [
            'user_id' => auth()->id()
        ]);

        return to_route('todos.index')->with('status', 'Succesfully create new todo list');
    }

    public function edit(Todo $todo)
    {
        abort_unless(auth()->id() == $todo->user_id, 403, 'Forbidden');

        return view('pages.user.todos.edit', compact('todo'));
    }

    public function update(TodoUpdateRequest $todoUpdateRequest, Todo $todo)
    {
        $todo->update($todoUpdateRequest->validated());

        return to_route('todos.index')->with('status', "Succesfully update {$todo->name}");
    }

    public function destroy(Todo $todo)
    {
        abort_unless(auth()->id() == $todo->user_id, 403, 'Forbidden');

        $todo->delete();

        return to_route('todos.index')->with('status', "Succesfully delete {$todo->name}");
    }
}
