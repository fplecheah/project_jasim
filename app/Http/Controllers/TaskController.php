<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;

 
class TaskController extends Controller
{
    public function index(Request $request){
        return TaskResource::collection(Task::all());
    }

    public function show(Request $request,Task $task){
        return  TaskResource::make($task);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title'=>'required|255'
        ]);

        $task = Task::create($validated);
        return new TaskResource($task); 
    }
}
