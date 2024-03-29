<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoController;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = Todo::where('check_list_id', $request->check_list_id)->with('users')->get(); 

        return response()->json([
            'status' => true,
            'data' => $todos
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
    public function store(StoreTodoController $request)
    {
        $todo = Todo::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Todo Created successfully!",
            'data' => $todo
        ], 200);
    }

    public function updateStatus(Request $request, Todo $todo)
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

        if($request->status){
            $todo->update([
                'status' => true
            ]);
        }else{
            $todo->delete();
        }

        return response()->json([
            'status' => true,
            'message' => "Todo Update Status successfully!",
            'data' => $todo
        ], 200);
    }

    public function assignUser(Request $request, User $user, Todo $todo)
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

        $todo->users()->detach();

        $todo->users()->attach($user->id);

        return response()->json([
            'status' => true,
            'message' => "Assign User to Todo successfully!",
        ], 200);
    }

    public function unassignUser(Request $request, User $user, Todo $todo)
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

        if(!$todo->users->contains($user->id)){
            return response()->json([
                'status' => false,
                'message' => "User not assigned to this Task",
                'data' => null
            ], 422);
        }


        $todo->users()->detach($user->id);

        return response()->json([
            'status' => true,
            'message' => "Unassign User to Todo successfully!",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        if($request->due_date){
            $loginUser = $request->user('sanctum');
            if($loginUser->role != 'manager'){
                return response()->json([
                    'status' => false,
                    'message' => "User role doesn't have access",
                    'data' => null
                ], 422);
            }
        }

        $todo->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Todo Updated successfully!",
            'data' => $todo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json([
            'status' => true,
            'message' => "Todo Deleted successfully!",
        ], 200);
    }
}
