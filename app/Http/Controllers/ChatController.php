<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChatController extends Controller
{
    public function index() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('posts.chat');
    }
    
    public function sendMessage(Request $request) {
      event(new \App\Events\NewMessage($request->input('message')));   
    }
    
    public function sendPrivateMessage(Request $request) {
//      event(new \App\Events\PrivateMessage($request->all())); 
      \App\Events\PrivateMessage::dispatch($request->all());
      return $request->all();
    }
    
    public function getDBData() {
        $all_users = User::where([
            ['id', '!=', Auth::id()],
            ['confirmed', 1]
        ])->get();
        $result['dbusers'] = $all_users;
        return $result;
    }
    
}
