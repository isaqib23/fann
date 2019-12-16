<?php

namespace  App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    /**
     * @param $data
     * @param $folder
     * @param $sub_folder
     * @param null $format
     * @param int $width
     * @param int $height
     * @return array
     */
    public function storeImage($data, $folder, $sub_folder, $format = null, $width = 300, $height = 200)
    {
        $name   = date('Ymdhms').'_'.$data['name'];
        $folder = strtolower($folder);
        $path   = 'images/'.$folder.'/'.$sub_folder;

        switch ($folder) {
            case 'campaigns':
                $this->makeImage($path, 'original', $name, $data);
                $this->makeImage($path, 'medium', $name, $data, 450, 450);
                $this->makeImage($path, 'thumbnail', $name, $data, 100, 100);
                break;
            case 'profile':
                $this->makeImage($path, 'medium', $name, $data, 450, 450);
                $this->makeImage($path, 'thumbnail', $name, $data, 450, 450);
                break;

            case $folder:
            default:
                $this->makeImage($path, $format != null ? $format : 'default', $name, $data, $width, $height);
                break;
        }
        return [
            'name' => $name,
            'path' => $path
        ];
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @param $data
     * @param null $width
     * @param null $height
     */
    public function makeImage($path, $format, $name, $data, $width = null, $height = null)
    {
        if (env('STORAGE_LOCATION') == 's3') {
            return $this->storeS3($path, $format, $name, $data, $width, $height);
        }
        $this->storeLocal($path, $format, $name, $data, $width, $height);
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @param $data
     * @param $width
     * @param $height
     */
    public function storeS3($path, $format, $name, $data, $width, $height)
    {
        $img = Image::make($data['src'])->resize($width, $height);
        Storage::disk('s3')->put($path . '/' . $format . '/' . $name, $img);
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @param $data
     * @param $width
     * @param $height
     * @return \Intervention\Image\Image
     */
    public function storeLocal($path, $format, $name, $data, $width, $height)
    {
        $pathOriginal = public_path($path) . '/' . $format;

        if (!file_exists($pathOriginal)) {
            File::makeDirectory($pathOriginal, 777, true);
        }

        if ($format == 'original') {
            return Image::make($data['src'])->save($pathOriginal . '/' . $name);
        }
        Image::make($data['src'])->resize($width, $height)->save($pathOriginal . '/' . $name);
    }

    /**
     * @param $path
     * @param $format
     * @param $name
     * @return string
     */
    public function getImage($path, $format, $name)
    {
        if (env('STORAGE_LOCATION') == 's3') {
            return Storage::url($path . '/' . $format . '/' . $name);
        }
        return public_path($path) . '/' . $format . '/' . $name;
    }

}
