<?php

namespace  App\Helpers;

use Illuminate\Support\Facades\File;
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
        $this->publicPath =  public_path( 'images/');
    }

    /**
     * @param $data
     * @param null $folder
     * @param null $format
     * @param int $width
     * @param int $height
     * @return array
     */
    public function storeImage($data, $folder = null, $format = null, $width = 300, $height = 300)
    {
        $name = date('Ymdhms').'_'.$data['name'];
        $folder = $folder == null ? 'default' : strtolower($folder);

        //---original
        $pathOriginal = $this->publicPath.$folder.'/'.$data['campaign_id'].'/'.'original';
        if(!file_exists($pathOriginal)) {
             File::makeDirectory($pathOriginal,777,true);
        }
        Image::make($data['src'])->save($pathOriginal.'/'.$name);

        //---thumbnail
        $pathThumb = $this->publicPath.$folder.'/'.$data['campaign_id'].'/'.'thumbnail';
        if(!file_exists($pathThumb)) {
             File::makeDirectory($pathThumb,777,true);
        }
        Image::make($data['src'])->resize(100, 100)->save($pathThumb.'/'.$name);

        //--custom format
        if($format != null ){
            $path = $this->publicPath.$folder.'/'.$data['campaign_id'].'/'.$format;
            if(!file_exists($path)) {
                File::makeDirectory($path,777,true);
            }
            Image::make($data['src'])->resize($width, $height)->save($path.'/'.$name);
        }

        $image = array();
        $image['name'] = $name;
        $image['path'] = 'images/'.$folder.'/'.$data['campaign_id'];
        return $image;
    }
}
