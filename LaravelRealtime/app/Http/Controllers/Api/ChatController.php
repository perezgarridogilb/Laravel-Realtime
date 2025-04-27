<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function greetReceived(Request $request, User $user)
    {
        return "Greeting {$user->name} from {$request->user()->name}";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
