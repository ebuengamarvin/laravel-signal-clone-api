<?php

namespace App\Http\Controllers\api;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChat;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Chat as ChatResource;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ChatResource::collection(
            QueryBuilder::for(Chat::class)
                ->allowedFilters([
                    AllowedFilter::scope('chat_name_id'),
                ])
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChat $request)
    {
        $chat = new Chat();
        $chat->message = $request->message;
        $chat->user_id = auth()->user()->id;
        $chat->chat_name_id = $request->chat_name_id;
        $chat->saveOrFail();

        return new ChatResource(Chat::findOrFail($chat->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ChatResource(Chat::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
