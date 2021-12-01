<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::latest()->get();
        return view('tasks.index',[
            'tasks' => $tasks
        ]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){ // 데이터 접근 가능
        request()->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $task = Task::create(request(['title','body']));

        return redirect('/tasks/'.$task->id);
    }

    public function show(Task $task){ // laravel에서 모델자료형을 앞에 붙여주면 알아서 $task에 맞는 열을 찾아 $task변수에 넣어준다.

        return view('tasks.show',[
            'task' => $task
        ]);
    }

    public function edit(Task $task){
        return view('tasks.edit',[
            'task'=> $task
        ]);
    }

    public function update(Task $task){
        request()->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $task->update(request(['title','body']));
        return redirect('/tasks/'.$task->id);
    }

    public function destroy(Task $task){
        $task->delete();
        return redirect('/tasks');
    }
}
