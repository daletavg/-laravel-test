<?php
function GetPathToPhoto(string $pathToImage,string $defaultPath,$storage='public'){
    return \Illuminate\Support\Facades\Storage::disk($storage)->exists($pathToImage)? Storage::disk($storage)->url($pathToImage):$defaultPath;
}
function FileExists(string $pathToImage,string $storage = 'public')
{
    return \Storage::disk($storage)->exists($pathToImage);
}
function imgOrig(string $pathToImage)
{
    return str_replace('_s', '', $pathToImage);
}
function GetImageAdmin(string $pathToImage,string $defaultPath,$storage='public')
{
    return "<img width=150 id='imageUploaded' src='".GetPathToPhoto($pathToImage,$defaultPath,$storage)."' alt=''>";
}
