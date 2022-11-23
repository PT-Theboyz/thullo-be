<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckList;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCheckListRequest;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkLists = CheckList::where('task_id', $request->task_id)->with('todos')->get(); 

        return response()->json([
            'status' => true,
            'data' => $checkLists
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
    public function store(StoreCheckListRequest $request)
    {
        $checkList = CheckList::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Check List Created successfully!",
            'data' => $checkList
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckList $checkList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckList $checklist)
    {
        $checklist->update([
            "name" => $request->name
        ]);

        return response()->json([
            'status' => true,
            'message' => "Check List Updated successfully!",
            'data' => $checklist
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checklist)
    {
        $checklist->delete();

        return response()->json([
            'status' => true,
            'message' => "Check List Deleted successfully!",
        ], 200);
    }
}
