<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttachmentRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreAttachmentRequest $request, Task $task)
    {
        $user = $request->user('sanctum');

        $attachment = Attachment::create([
            "name" => $request->name,
            "filename" => time().'-'.$request->name,
            "format" => $request->format,
            "task_id" => $task->id
        ]);

        Comment::create([
            "description" => "Add Attachment ". $attachment->filename. " to this task",
            "user_id" => $user->id,
            "task_id" => $task->id
        ]);
        

        return response()->json([
            'status' => true,
            'message' => "Create Attachment successfully!",
            'data' => $attachment
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return response()->json([
            'status' => true,
            'message' => "Attachment Deleted successfully!",
        ], 200);
    }
}
