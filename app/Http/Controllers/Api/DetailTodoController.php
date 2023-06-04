<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Store;
use App\Http\Requests\StoreDetailTodoRequest;
use App\Models\DetailTodo;


class DetailTodoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $detailTodos = DetailTodo::where('todo_id', $request->todo_id)->get();


        return response()->json([
            'status' => true,
            'data' => $detailTodos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailTodoRequest $request)
    {
        $detailTodo = DetailTodo::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Detail Todo Created successfully!",
            'data' => $detailTodo
        ], 200);
    }

    public function update(Request $request, DetailTodo $detailtodo)
    {
        $detailtodo->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Detail Todo Updated successfully!",
            'data' => $detailtodo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTodo $detailtodo)
    {
        $detailtodo->delete();

        return response()->json([
            'status' => true,
            'message' => "Detail Todo Deleted successfully!",
        ], 200);
    }
    
}
