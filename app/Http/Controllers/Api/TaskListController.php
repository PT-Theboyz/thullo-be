<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskListRequest;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taskLists = TaskList::where('board_id', $request->board_id)->get(); 

        return response()->json([
            'status' => true,
            'data' => $taskLists
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
    public function store(StoreTaskListRequest $request)
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

        $taskList = TaskList::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Task List Created successfully!",
            'data' => $taskList
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function show(TaskList $taskList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskList $taskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskListRequest $request, TaskList $taskList)
    {
        //Check User Role
        // $user = $request->user('sanctum');
        // if($user->role != 'manager'){
        //     return response()->json([
        //         'status' => false,
        //         'message' => "User role doesn't have access",
        //         'data' => null
        //     ], 422);
        // }

        try {

            $res = $taskList->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Task List Updated successfully!",
                'data' => $res
            ], 200);
        
        } catch (\Exception $exception) {
            dump($exception);
            dd($exception->getMessage());
        
        }


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TaskList $taskList)
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

        $taskList->delete();

        return response()->json([
            'status' => true,
            'message' => "Task List Deleted successfully!",
        ], 200);
    }
}
