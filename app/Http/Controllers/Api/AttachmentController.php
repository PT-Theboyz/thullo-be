<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttachmentRequest;


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
        $attachment = new Attachment;

        if($request->file()){
            $filename = time().'-'.$request->file->getClientOriginalName();

            //upload file to storage
            $request->file('file')->storeAs('attachments', $fileName, 'public');
            $attachment->name = $request->file->getClientOriginalName();
            $attachment->$filename = $fileName;
            $attachment->$format = $request->file->getClientOriginalExtension();
            $attachment->$task_id = $task->id;

            return response()->json([
                'status' => true,
                'message' => "Attachment Upload successfully!",
                'data' => $attachment
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => "File request error",
                'data' => null
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
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
        //
    }
}
