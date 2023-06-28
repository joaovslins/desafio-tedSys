<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    

    //action Index
    public function index(){

        $tasks = Task::all();

        return view('task.index', ['tasks' => $tasks]);
    }

    //action Create
    public function create(){
        return view('task.create');
    }

    //action Save
    public function save(Request $request){
        $task = new Task();

        
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');

        if($task->save()){
            return redirect()->route('task.index')->with('success', 'Atividade Salva!');
        };
        
        return redirect()->route('task.index')->with('danger', 'Erro ao atualizar atividade');
    }

    //action edit
    public function edit($id){
        $task = Task::find($id);

        return view('task.update', ['task' => $task]);
    }

    //action update
    public function update(Request $request, $id){
        $task = Task::find($id);
        
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority ;
        $task->status = $request->status;
        $task->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');

        if($task->save()){
            return redirect()->route('task.index')->with('success', 'Atividade Salva!');
        }

        return redirect()->route('task.index')->with('danger', 'Erro ao atualizar atividade');
    }

    //action delete
    public function destroy($id){
        $task = Task::find($id);

        if($task->delete()){
            return redirect()->route('task.index')->with('success', 'Atividade Excluída!');
        }

        return redirect()->route('task.index')->with('danger', 'Erro ao excluir atividade');        
    }

    //action view
    public function show($id){
        $task = Task::find($id);

        return view('task.show', ['task' => $task]);
    }

    
    //response formater json status
    public function listStatus(){
        $status = [
            ['value' => 1, 'text' => 'Pendente'],
            ['value' => 2, 'text' => 'Em andamento'],
            ['value' => 3, 'text' => 'Concluído']
        ];

        return response()->json($status);
    }

    //response formater json priority
    public function listPriority(){
        $status = [
            ['value' => 1, 'text' => 'Baixo'],
            ['value' => 2, 'text' => 'Médio'],
            ['value' => 3, 'text' => 'Alto']
        ];

        return response()->json($status);
    }

}

