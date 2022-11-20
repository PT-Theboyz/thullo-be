<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLabelRequest;


class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labels = Label::where('board_id', $request->board_id)->with('tasks')->get(); 

        return response()->json([
            'status' => true,
            'data' => $labels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        //Check User Role
        $user = $request->user('sanctum');
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        $label = Label::create($request->all());

        $label->tasks()->attach($request->task_id);

        return response()->json([
            'status' => true,
            'message' => "Label Created successfully!",
            'data' => $label
        ], 200);
    }

    public function assignLabel(Request $request, Task $task, Label $label,)
    {
        //Check User Role
        $user = $request->user('sanctum');
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if($label->tasks->contains($task->id)){
            return response()->json([
                'status' => false,
                'message' => "Task Already Assign to this Label",
                'data' => null
            ], 422);
        }

        $label->tasks()->attach($task->id);

        return response()->json([
            'status' => true,
            'message' => "Assign Task to Label successfully!",
        ], 200);
    }

    public function unassignLabel(Request $request, Task $task, Label $label)
    {
        //Check User Role
        $user = $request->user('sanctum');
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if(!$label->tasks->contains($task->id)){
            return response()->json([
                'status' => false,
                'message' => "Task not assigned to this Label",
                'data' => null
            ], 422);
        }

        $label->tasks()->detach($task->id);

        return response()->json([
            'status' => true,
            'message' => "Unassign Task to Label successfully!",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $label = Task::where('id', $id);
        return response()->json([
            'status' => true,
            'data' => $label
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLabelRequest $request, Label $label)
    {
        //Check User Role
        $user = $request->user('sanctum');
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        $label->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Label Updated successfully!",
            'data' => $label
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Label $label)
    {
        //Check User Role
        $user = $request->user('sanctum');
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        $label->delete();

        return response()->json([
            'status' => true,
            'message' => "Label Deleted successfully!",
        ], 200);

    }
}
