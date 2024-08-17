<?php

use App\Models\Admin\Message;

function getLastMessage($group)
{
    $lastMessage = Message::where([
        ['sender_id', $group->sender_id],
        ['sender_type', $group->sender_type],
        ['receiver_id', $group->receiver_id],
        ['receiver_type', $group->receiver_type],
    ])->latest()->first();

    return $lastMessage ? $lastMessage->message : '';
}
