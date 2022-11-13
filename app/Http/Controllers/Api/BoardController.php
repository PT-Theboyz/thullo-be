<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBoardRequest;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::with('users')->get();

        return response()->json([
            'status' => true,
            'data' => $boards
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
    public function store(StoreBoardRequest $request)
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
        
        $board = Board::create($request->all());

        // Attach First User to Board
        if(!$board->users->contains($user->id)){
            $board->users()->attach($user->id);
        }

        return response()->json([
            'status' => true,
            'message' => "Board Created successfully!",
            'data' => $board
        ], 200);
    }

    public function assignUser(User $user, Board $board)
    {
        //Check User Role
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if($board->users->contains($user->id)){
            return response()->json([
                'status' => false,
                'message' => "User Already Assign to this board",
                'data' => null
            ], 422);
        }


        $board->users()->attach($user->id);

        return response()->json([
            'status' => true,
            'message' => "Assign User to Board successfully!",
            // 'data' => $board::with("users")->get()
        ], 200);
    }

    public function unassignUser(User $user, Board $board)
    {

        //Check User Role
        if($user->role != 'manager'){
            return response()->json([
                'status' => false,
                'message' => "User role doesn't have access",
                'data' => null
            ], 422);
        }

        if(!$board->users->contains($user->id)){
            return response()->json([
                'status' => false,
                'message' => "User not assigned to this Board",
                'data' => null
            ], 422);
        }


        $board->users()->detach($user->id);

        return response()->json([
            'status' => true,
            'message' => "Unassign User to Board successfully!",
            // 'data' => $board::with("users")->get()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return response()->json([
            'status' => true,
            'data' => $board
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBoardRequest $request, Board $board)
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

        $board->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Board Updated successfully!",
            'data' => $board
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Board $board)
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

        $board->delete();

        return response()->json([
            'status' => true,
            'message' => "Board Deleted successfully!",
        ], 200);
    }
}
