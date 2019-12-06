<?php

namespace  App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
     /**
     * @var array
     */
    public $image = array();

    /**
     * @var string
     */
    protected $publicPath;

    /**
     * ImageHelper constructor.
     * @param $data
     * @param null $format
     */
    public function __construct() {
        $this->publicPath =  public_path( 'images/');
    }

    /**
     * @return string
     */
    public function storeImage($data,$format=null)
    {
        $name = date('Ymd').'_'.$data['name'];

        $pathOriginal = $this->publicPath.$data['type'].'/'.$data['id'].'/'.'original'.'/'.$name;
        Image::make($data['src'])->save($pathOriginal);

        $pathThumb = $this->publicPath.$data['type'].'/'.$data['id'].'/'.'thumbnail'.'/'.$name;
        Image::make($data['src'])->resize(100, 100)->save($pathThumb);

        if($this.format != null ){
            $path = $this->publicPath.$data['type'].'/'.$data['id'].'/'.$this.format.'/'.$name;
            Image::make($data['src'])->resize(100, 100)->save($path);
        }

        $this.image.push($name);
        $this.image.push('images/'.$data['type'].'/'.$data['id']);

        dd($this.image);
        return $this.image;
    }
}
