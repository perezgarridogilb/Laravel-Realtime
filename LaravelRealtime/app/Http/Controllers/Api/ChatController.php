<?php

namespace App\Http\Controllers\Api;

use App\Events\GreetingSent;
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
     * Función de saludo
     *
     * @param Request $request es el emisor
     * @param User $user es el destinatario
     * @return string
     */
    public function greetReceived(Request $request, User $user)
    {
        // la persona saludada
        broadcast(new GreetingSent($user, "{$request->user()->name} greeted you"));
        // aviso a la persona que saluda
        broadcast(new GreetingSent($request->user(), "you greeted {$request->name}"));

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
