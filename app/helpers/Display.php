<?php

namespace App\Helpers;

class Display
{
    public static function status_order($value)
    {
        if($value == 'notYet')
        {
            return '<i class="fa-solid fa-bars-progress" style="color:orange"></i>';
        }else{
            return '<i class="fa-solid fa-thumbs-up"style="color:green"></i>';
        }
    }

    public static function upload_image($file, $path)
    {
        $background = $file;
        $filename = time() . '-' . rand() . '-' . $background->getClientOriginalName();
        $background->move(public_path('/img/'.$path), $filename);
        return $filename;
    }
        
}