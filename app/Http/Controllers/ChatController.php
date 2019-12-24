<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

/**
 * The chat controller.
 */
class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this=>middleware('https');
        $this->middleware('auth');
        $this->middleware('impersonate');
    }

    /**
     * Show the chat page.
     *
     * @param int $roomId The chat room id.
     *
     * @return \Illuminate\Contracts\Support\Renderable Show the chat room.
     */
    public function index($roomId)
    {
        return view('chat')->with('info', Room::where('id', $roomId)->first());
    }

    /**
     * Allow user to join chat room
     * 
     * @param Room $room
     * @param \Illuminate\Http\Request $request
     */
    public function join(Room $room, Request $request) 
    {
        try {
            $room->join($request->user());
            event(new RoomJoined($request->user(), $room));
        } catch (Exception $e) {
            Log::error('Exception while joining a chat room', [
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
            return back();
        }
        return redirect()->route('rooms.show', ['room' => $room->id]);
    }

    /**
     *
     *
     *
     */
    public function fetchMessages($roomId)
    {
        return Message::with('user')->get();
    }
    public function sendMessage(Request $request, $roomId)
    {
        
        $message = auth()->user()->messages()->create(['message' => $request->message, 'room_id' => $roomId]);
		broadcast(new MessageEvent(auth()->user(), $message, $room))->toOthers();
        return;
    }
}
