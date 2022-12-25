<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Inertia\Inertia;

class ChatsController extends Controller
{

    public function index()
    {
        return Inertia::render('Chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        //return ['status' => 'Message Sent!'];
    }
}
