<?php

namespace  App\Helpers;

use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    /**
     * @var string
     */
    protected $publicPath;

    /**
     * ImageHelper constructor.
     */
    public function __construct() {

    }

    /**
     * @param $data
     * @param null $folder
     * @param null $format
     * @param int $width
     * @param int $height
     * @return array
     */
    public function storeImage($data, $folder = null, $id, $format = null, $width = 300, $height = 300)
    {

        $name = date('Ymdhms').'_'.$data['name'];
        $folder = $folder == null ? 'default' : strtolower($folder);
        $path = 'images/'.$folder.'/'.$id;

        //---original
        if(env('STORAGE_LOCATION') == 's3') {
            Storage::disk('s3')->put($path.'/'.'original/'.$name,$data['src']);
        }else {
            $pathOriginal = public_path($path).'/'.'original';
//            dd($pathOriginal);
            if(!file_exists($pathOriginal)) {
                File::makeDirectory($pathOriginal,777,true);
            }

            Image::make($data['src'])->save($pathOriginal.'/'.$name);

        }

        //---thumbnail
        if(env('STORAGE_LOCATION') == 's3') {
            Storage::disk('s3')->put($path.'/'.'thumbnail/'.$name,$data['src']);
        }else {
            $pathThumb =  public_path($path.'/'.'thumbnail');
            if (!file_exists($pathThumb)) {
                File::makeDirectory($pathThumb, 777, true);
            }
            Image::make($data['src'])->resize(100, 100)->save($pathThumb . '/' . $name);
        }
        //--custom format
            if ($format != null) {
                if(env('STORAGE_LOCATION') == 's3') {
                    Storage::disk('s3')->put($path.'/'.$format.'/'.$name,$data['src']);
                }else {
                    $customPath = public_path($path.'/'.$format);
                    if (!file_exists($customPath)) {
                        File::makeDirectory($customPath, 777, true);
                    }
                    Image::make($data['src'])->resize($width, $height)->save($customPath . '/' . $name);
                }
            }

        $image = array();
        $image['name'] = $name;
        $image['path'] = $path;
        return $image;
    }
}
