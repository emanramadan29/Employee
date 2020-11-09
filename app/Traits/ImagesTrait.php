<?php
namespace App\Traits;

Trait ImagesTrait{

    function SaveImage($img,$path){
        $imageName = uniqid().'.'.$img->getClientOriginalExtension();
        $img->move(public_path($path), $imageName);
        return $imageName;
    }


}
