<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Mail\AssignMemberMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('board_id', $request->board_id)->with('users', "checklists.todos")->get(); 

        return response()->json([
            'status' => true,
            'data' => $tasks
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
    public function store(StoreTaskRequest $request)
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
        
        $task = Task::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Task Created successfully!",
            'data' => $task
        ], 200);
    }

    public function assignUser(Request $request, User $user, Task $task)
    {
        //Check User Role
        $loginUser = $request->user('sanctum');
        if($loginUser->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if($task->users->contains($user->id)){
            return response()->json([
                'status' => false,
                'message' => "User Already Assign to this task",
                'data' => null
            ], 422);
        }


        $task->users()->attach($user->id);

        Comment::create([
            "description" => "Assign User ". $user->name. " to this task",
            "user_id" => $loginUser->id,
            "task_id" => $task->id
        ]);

        $mailRes = Mail::to($user->email)->send(new AssignMemberMail($user->name, $task->title, $task->description, $task->due_date));

        return response()->json([
            'status' => true,
            'message' => "Assign User to Task successfully!",
            'mailRes' => $mailRes
        ], 200);
    }

    public function unassignUser(Request $request, User $user, Task $task)
    {

        //Check User Role
        $loginUser = $request->user('sanctum');
        if($loginUser->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if(!$task->users->contains($user->id)){
            return response()->json([
                'status' => false,
                'message' => "User not assigned to this Task",
                'data' => null
            ], 422);
        }


        $task->users()->detach($user->id);

        Comment::create([
            "description" => "Unassign User ". $user->name. " to this task",
            "user_id" => $loginUser->id,
            "task_id" => $task->id
        ]);

        return response()->json([
            'status' => true,
            'message' => "Unassign User to Task successfully!",
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id);
        return response()->json([
            'status' => true,
            'data' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //Check User Role
        $user = $request->user('sanctum');
        // if($user->role != 'manager'){
        //     return response()->json([
        //         'status' => false,
        //         'message' => "User role doesn't have access",
        //         'data' => null
        //     ], 422);
        // }

        

        $task->update($request->all());

        if($request->due_date){
            Comment::create([
                "description" => "Add Due Date ". $request->due_date. " to this task",
                "user_id" => $user->id,
                "task_id" => $task->id
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Task Updated successfully!",
            'data' => $task
        ], 200);
    }

     /**
     * Update position of task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request, Task $task)
    {
        if(!$request->position){
            return response()->json([
                'status' => false,
                'message' => "Position should be filled!",
                'data' => null
            ], 422);
        }

        $temp = $task->position;

        $existingTask = Task::where('position', $request->position)->first();

        if($existingTask){
            $existingTask->update([
                'position' => $temp
            ]);
        }

        $task->update([
            'position' => $request->position
        ]);
        



        return response()->json([
            'status' => true,
            'message' => "Update Position Task successfully!",
            'data' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
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

        $task->delete();

        return response()->json([
            'status' => true,
            'message' => "Task Deleted successfully!",
        ], 200);
    }
}
