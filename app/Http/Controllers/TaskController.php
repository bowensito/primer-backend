<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
class TaskController extends Controller
{
    public function getAll(Request $request){
        $user_id=$request->user();
        if ($user_id){
            $user=User::find($user_id);
            if($user){
                $userTasks= Task:where('user_id', '=', $user_id);
        $tasks = Task::all();
        return $tasks;
    }
    public function createTask(Request $request){
        $data = $request->all();//obtiene el cuerpo de la peticion (datos del front end)
        // $data['id_user']
        // $data['text']
        $user=User::find($data['user_id']);
        if($user){
            
            $task=Task::create([
                'user_id' => $data['user_id'],
                'text' => $data['text']
            ]);
            return response()->json([
                'message'=> "tarea creada con exito", 
                'task'=>$task]);
        }else{
            return response()->json([
                'message'=> "usuario no encontrado"]);
        }
    }
}
