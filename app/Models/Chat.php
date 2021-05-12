<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function chat()
    {
        return $this->hasOne(ChatName::class, 'id', 'chat_name_id');
    }

    public function scopeChatNameId(Builder $query, $chat_name_id): Builder
    {
        return $query->whereHas('chat', function ($query) use ($chat_name_id) {
            $query->where('chat_name_id', $chat_name_id);
        });
    }
}
