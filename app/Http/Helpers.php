<?php

function errorCheck($value){
     return (@$value != null) ? $value  : "Not Found Data";
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
