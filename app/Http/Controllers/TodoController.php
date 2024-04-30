<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomForbiddenException;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $todo = Todo::where('user_id', $user->id)->get();
        return response()->json($todo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = new Todo;
        $todo->fill($request->validated());
        $todo->fill(['user_id' => $request->user()->id]);
        $todo->save();
        return $todo;
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $todo->update([
            'title' => $request->title ?? $todo->title,
            'done' => $request->done ?? $todo->done,
        ]);
        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
