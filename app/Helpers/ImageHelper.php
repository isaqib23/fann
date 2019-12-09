<?php

namespace  App\Helpers;

use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    /**
     * ImageHelper constructor.
     */
    public function __construct() {
    }

    /**
     * @param $data
     * @param string $format
     * @param null $folder
     * @param $sub_folder
     * @param null $size
     * @return array
     */
    public function storeImage($data, $format = 'all',  $folder = null, $sub_folder, $width = 100, $height = 100 )
    {
        $name = date('Ymdhms').'_'.$data['name'];
        $folder = $folder == null ? 'default' : strtolower($folder);
        $path = 'images/'.$folder.'/'.$sub_folder;

        switch($format ) {
           case 'all':
               if (env('STORAGE_LOCATION') == 's3') {
                   $this->storeS3($path, 'original', $name, $data);
                   $this->storeS3($path, 'thumbnail', $name, $data);
               } else {
                   $this->makeImage($path, 'original', $name, $data);
                   $this->makeImage($path, 'thumbnail', $name, $data,$width,$height);
               }
           break;
           case 'original':
               if (env('STORAGE_LOCATION') == 's3') {
                   $this->storeS3($path, $format, $name, $data);
               } else {
                   $this->makeImage($path, $format, $name, $data);
               }
               break;
           case 'thumbnail':
               if (env('STORAGE_LOCATION') == 's3') {
                   $this->storeS3($path, $format, $name, $data);
               } else {
                   $this->makeImage($path, $format, $name, $data,$width,$height);
               }
               break;
           case $format:
               if (env('STORAGE_LOCATION') == 's3') {
                   $this->storeS3($path, $format, $name, $data);
               } else {
                   $this->makeImage($path, $format, $name, $data,$width,$height);
               }
               break;
         }

        $image = array();
        $image['name'] = $name;
        $image['path'] = $path;
        return $image;
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @param $data
     */
    public function storeS3($path,$format,$name,$data)
    {
        $img =Image::make($data['src'])->resize(100,100);
        Storage::disk('s3')->put($path.'/'.$format.'/'.$name,$img);
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @param $data
     * @param null $width
     * @param null $height
     */
    public function makeImage($path,$format,$name,$data,$width=null,$height=null)
    {
        $pathOriginal = public_path($path).'/'.$format;

        if(!file_exists($pathOriginal)) {
            File::makeDirectory($pathOriginal,777,true);
        }

        if($format == 'original'){
            Image::make($data['src'])->save($pathOriginal.'/'.$name);
        }else{
            Image::make($data['src'])->resize($width,$height)->save($pathOriginal.'/'.$name);
        }

    }
}
