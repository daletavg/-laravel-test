<?php
namespace App\Helpers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
class ImageSaver
{
    private $storage;
    private $nameKey;
    private $request;
    private $folderName;
    public function __construct(Request $request,string $folderName = 'images',string $nameKey = 'image',string $storage = 'public')
    {
        $this->storage=$storage;
        $this->nameKey = $nameKey;
        $this->request = $request;
        $this->folderName = $folderName;
    }
    private function checkImage(){
        return $this->request->hasFile($this->nameKey);
    }
    public function saveImage():string
    {
        if($this->checkImage()) {
            return $this->save($this->request->file($this->nameKey));
        } else {
            return '';
        }
    }
    public function saveManyImages():array
    {
        $imageArr = [];
        $images =$this->request->all()[$this->nameKey];
        foreach ($images as $image){
            array_push($imageArr,$this->save($image));
        }
        return $imageArr;
    }
    public function save(UploadedFile $uploadFile):string
    {
        $file = $uploadFile;
        $name =$file->getClientOriginalName().''.time();
        $file_name = $this->folderName . "/" . md5($name) . "." . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $file_name_s = $this->folderName . "/" . md5($name) . "_s." . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        \Illuminate\Support\Facades\Storage::disk($this->storage)->put($file_name, file_get_contents($file->getRealPath()));
        \Illuminate\Support\Facades\Storage::disk($this->storage)->put($file_name_s, self::thumbnailImage($file->getRealPath()));
        return $file_name_s;
    }
    static function thumbnailImage($imagePath, $cols = 250, $rows = 250)
    {
        $ext = 'jpg';
        $image = Image::make($imagePath);
        $image->fit($cols, $rows);
        return $image->stream($ext);
    }
    static function deleteImage(string $photoPath, string $storage= 'public')
    {
        if (is_null($photoPath) || strlen($photoPath)==0) {
            return;
        }
        try {
            Storage::disk($storage)->delete($photoPath);
            Storage::disk($storage)->delete(imgOrig($photoPath));
        } catch (Exception $exception) {
            return;
        }
    }
}
