<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function room(Request $request){
        return ChatRoom::all();
    }
    public function messages(Request $request, $roomId){
        return ChatMessage::where('chat_room_id',$roomId)
                ->with('user')
                ->orderBy('create_at','DESC')
                ->get();
    }
    public function newMessage(Request $request , $roomId){
        $newmessage=new ChatMessage;
        $newmessage->user_id=Auth::id();
        $newmessage->chat_room_id=$roomId;
        $newmessage->message=$request->message;
        $newmessage->save();
        return $newmessage;
    }
}
