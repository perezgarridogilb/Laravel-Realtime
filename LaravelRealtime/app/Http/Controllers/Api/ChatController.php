<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        /** middleware que se asegura de que el usuario haya iniciado sesión */
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function showChat()
    {
        xdebug_break();
        return view('chat.show');
    }

    /**
     * Display the specified resource.
     */
    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        $request->validate($rules);

        broadcast(new MessageSent($request->user(), $request->message));

        return response()->json(['message'=> 'Message broadcast']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
