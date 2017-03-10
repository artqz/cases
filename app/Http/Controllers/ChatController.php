<?php

namespace App\Http\Controllers;

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

        Message::create([
            'user_id' => Auth::id(),
            'text' => $request->input('text'),
        ]);

        return redirect()->back()->with([
            'flash_message' => 'Вы успешно добавили сообщение',
            'flash_message_status' => 'success',
        ]);
    }
}
