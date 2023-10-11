<?php

namespace App\Http\Controllers;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function insertmsg(Request $request){
        $insertmsg = new Message();
        $insertmsg->message = $request['message'];
        $insertmsg->sender_id = auth()->user()->id;
        $insertmsg->receiver_id = $request['receiver_id'];
        $insertmsg->save();

        $user_id = $request->receiver_id;
        $fetch = Message::whereIn('sender_id',[auth()->user()->id, $user_id])->whereIn('receiver_id',[$user_id, auth()->user()->id])->get();
        return $fetch;
        return true;
    }
    

    public function fetchmsg(Request $request){
        $user_id = $request->id;
        $fetch = Message::whereIn('sender_id',[auth()->user()->id, $user_id])->whereIn('receiver_id',[$user_id, auth()->user()->id])->get();
        return $fetch;
    }

}
