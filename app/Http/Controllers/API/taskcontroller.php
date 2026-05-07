<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\task;
use Illuminate\Console\View\Components\Task as ComponentsTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Prompts\Task as PromptsTask;

class taskcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = task::with('project')->get();

        return response()->json($tasks, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'nullable|date'
        ]);

        if ($validator->fails()){
            return response()->json([
                'masage' => $validator->errors()
            ], 400);
        }

        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = task::with('project')->find($id);

        if(!$task){
            return response()->json([
                'massage' => 'task not found'
            ], 404);
        }

         return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $task = task::with('project')->find($id);

        if(!$task){
            return response()->json([
                'massage' => 'task not found'
            ], 404);
        }

         $validator = Validator::make($request->all(),[
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'due_date' => 'nullable|date'
        ]);

        if ($validator->fails()){
            return response()->json([
                'masage' => $validator->errors()
            ], 400);
        }

        $task->project_id = $request->project_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return response()->json([
            'massage' => 'task updated',
            $task
        ],201);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $task = task::with('project')->find($id);

        if(!$task){
            return response()->json([
                'massage' => 'task not found'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'massage' => 'task deleted',
            ],200);
        


    }
}
