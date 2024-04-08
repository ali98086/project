<?php

namespace App\Http\Services\Image;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService{


    protected $pathImage;
    protected $nameImage;



    public function checkExistsDirectory(string $path){

        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0755, true);

        }

    }



    public function setPathImage(string $path){

        $this->pathImage= $path.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

    }



    public function getPathImage(){

        return $this->pathImage;

    }



    public function setNameImage($image){

        $this->nameImage= uniqid().'.'. $image->getClientOriginalExtension();

    }



    public function getNameImage(){

        return $this->nameImage;

    }



    public function saveImageToPublic($image, $size = null){

        $manager = new ImageManager(new Driver()); 
        $img = $manager->read($image);
        
        if($size != null){

            $this->setSizeImage($img, $size);

        }

        $save= $img->save($this->fullPath());
        return $save ? true : false;

    }



    public function saveImageToStorage($image){

        $manager = new ImageManager(new Driver()); 
        $img = $manager->read($image);
        $imagePath= $this->getPathImage();
        $imageName= $this->getNameImage();

        $save= $img->save(Storage::putFileAs($imagePath , $image , $imageName));
        return $save ? true : false;

    }



    public function fullPath(){

        return $this->getPathImage().$this->getNameImage();

    }



    public function getSizeImage($imagePath , $placeSave){


        if($placeSave == 'public'){

            return File::size($imagePath);

        }
        else{

            return Storage::size($imagePath);

        }
        

    }



    public function getFormatImage($image){

        return $image->getClientOriginalExtension();

    }



    public function deleteImage($path){

        if(File::exists(public_path($path))){

            return File::delete($path);

        }
        elseif(Storage::exists($path)){

            return Storage::delete($path);

        }

    }


    public function checkPlaceSavedImage($path){

        if(File::exists(public_path($path))){

            return 'public';

        }
        elseif(Storage::exists($path)){

            return 'storage';

        }


    }


    public function saveImageTo($image, $place){

        if($place == 'public'){

            return $this->saveImageToPublic($image);

        }
        elseif($place == 'storage'){

            return $this->saveImageToStorage($image);

        }

    }


    public function changeImageDirectory($path){

        if(File::exists(public_path($path))){

            return File::move(public_path($path) ,storage_path('app'.DIRECTORY_SEPARATOR.$path)); 

        }
        elseif(Storage::exists($path)){

            return File::move(storage_path('app'.DIRECTORY_SEPARATOR.$path) ,public_path($path));

        }

    }

    public function setSizeImage($img , $size){

        if($size == 'small'){

            $img->resize(160,120);

        }

        if($size == 'medium'){

            $img->resize(320,240);

        }

        if($size == 'large'){

            $img->resize(800,600);

        }


    }
    

}


















?>