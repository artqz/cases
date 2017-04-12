<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function store_message (Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:200',
        ]);
        $user = User::where('id', Auth::id())->first();
        if ($user->isSpamer != 1) {
            Message::create([
                'user_id' => $user->id,
                'text' => $request->input('text'),
            ]);

            return redirect()->back()->with([
                'flash_message' => 'Вы успешно добавили сообщение',
                'flash_message_status' => 'success',
            ]);
        }
        return redirect()->back()->with([
            'flash_message' => 'Вы не можете писать в Чат!',
            'flash_message_status' => 'danger',
        ]);
    }
}
