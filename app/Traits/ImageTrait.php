<?php
namespace App\Traits;
use App\Helpers\ImageSaver;
use App\Models\Image;
use Illuminate\Http\Request;
trait ImageTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'model');
    }
    public function saveImage(Request $request,string $nameKey ='image'){
        if($request->has($nameKey)&& $request->get($nameKey) !== 'undefined' && $images = $this->images()->get() ){
            foreach ($images as $image){
                ImageSaver::deleteImage($image->path);
                $image->delete();
            }
            $this->images()->save(
                new Image([
                    'path' => (new ImageSaver($request, $this->getTableName()))->saveImage()
                ])
            );
        }
    }
    public function delete()
    {
        if(count($images = $this->images()->get())){
            foreach ($images as $image){
                ImageSaver::deleteImage($image->path);
                $image->delete();
            }
        }
        return parent::delete();
    }
}
