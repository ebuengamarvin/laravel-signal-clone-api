<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatName extends Model
{
    use HasFactory;

    public function chat()
    {
        return $this->hasOne(Chat::class, 'chat_name_id', 'id')->orderBy('id', 'desc');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'chat_name_id', 'id');
    }
}
