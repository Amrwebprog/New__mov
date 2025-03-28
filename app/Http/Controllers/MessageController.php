<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Message = Message::paginate(30);
        return $this->response(code: 200, data: $Message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $request = $request->validated();
        $user_id = Auth::user()->id;
        $request['user_id'] = $user_id;
        //insert
        $insert = Message::create($request);
        //check if insert
        if ($insert) {
            return $this->response(code: 200, data: $insert);
        } else {
            return $this->response(code: 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $id = $message->id;
        $message = Message::with('users')->find($id);
        return $this->response(code: 200, data: $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
    public function delete(Message $message)
    {
        $delete = $message->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Message $message)
    {
        $deleted = $message->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($message)
    {
        $message = Message::withTrashed()->where('id', $message)->restore();
        return $this->response(code: 202, data: $message);
    }
    public function delete_from_trash($message)
    {
        $message = Message::where('id', $message)->forceDelete();
        return $this->response(code: 202, data: $message);
    }
}
