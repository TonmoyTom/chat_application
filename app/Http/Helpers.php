<?php

function errorCheck($value)
{
    return (@$value != null) ? $value : "Not Found Data";
}

function uploadFile($file, $folder = '/'): ?string
{
    if ($file) {
        $image_name = Rand() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $image_name, 'public');
    }
    return null;
}

function setImage($url = null, $type = null, $default_image = true): string
{
    return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_image.png') : '');
}


function lastMessage($id)
{
    $message = \App\Models\Conversation::where(function ($q) use ($id) {
        $q->where('to_id', $id);
        $q->where('from_id', auth()->id());
    })->orWhere(function ($q) use ($id) {
        $q->where('to_id', auth()->id());
        $q->where('from_id', $id);
    })->latest()->first();


    if ($message != null) {
        $totalDuration = \Carbon\Carbon::now()->diffInSeconds($message->created_at);
        $second = \Carbon\CarbonInterval::seconds($totalDuration)->cascade()->forHumans();
        $data = [
            'message' => $message->message,
            'date' => $second,
            'message_type' => $message->message_type,
        ];
        return $data;
    } else {
        return '';
    }
}

function lastMessageDate($id)
{
    $message = \App\Models\Conversation::where('to_id', $id)->orWhere('from_id', $id)->latest()->first();
    if ($message != null) {

        return $second;
    } else {
        return '';
    }

}

function messageDate($value)
{
    if ($value != null) {
        $totalDuration = \Carbon\Carbon::now()->diffInSeconds($value);
        $second = \Carbon\CarbonInterval::seconds($totalDuration)->cascade()->forHumans();
        return $second;
    } else {
        return '';
    }

}
