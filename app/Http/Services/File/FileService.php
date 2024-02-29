<?php

namespace App\Http\Services\File;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService{


    protected $pathFile;
    protected $nameFile;



    public function checkExistsDirectory(string $path){

        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0755, true);

        }

    }



    public function setPathFile(string $path){

        $this->pathFile= $path.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

    }



    public function getPathFile(){

        return $this->pathFile;

    }



    public function setNameFile($file){

        $this->nameFile= uniqid().'.'. $file->getClientOriginalExtension();

    }



    public function getNameFile(){

        return $this->nameFile;

    }



    public function saveFileToPublic($file){

        $save= $file->move($this->getPathFile(), $this->getNameFile());
        return $save ? true : false;

    }



    public function saveFileToStorage($file){

        $filePath= $this->getPathFile();
        $fileName= $this->getNameFile();
        $save= Storage::putFileAs($filePath , $file , $fileName);
        return $save ? true : false;

    }



    public function fullPath(){

        return $this->getPathFile().$this->getNameFile();

    }



    public function getSizeFile($filePath , $placeSave){


        if($placeSave == 'public'){

            return File::size($filePath);

        }
        else{

            return Storage::size($filePath);

        }
        

    }



    public function getFormatFile($file){

        return $file->getClientOriginalExtension();

    }



    public function deleteFile($path){

        if(File::exists(public_path($path))){

            return File::delete($path);

        }
        elseif(Storage::exists($path)){

            return Storage::delete($path);

        }

    }


    public function checkPlaceSavedFile($path){

        if(File::exists(public_path($path))){

            return 'public';

        }
        elseif(Storage::exists($path)){

            return 'storage';

        }


    }


    public function saveFileTo($file, $place){

        if($place == 'public'){

            return $this->saveFileToPublic($file);

        }
        elseif($place == 'storage'){

            return $this->saveFileToStorage($file);

        }

    }


    public function changeFileDirectory($path){

        if(File::exists(public_path($path))){

            return File::move(public_path($path) ,storage_path('app'.DIRECTORY_SEPARATOR.$path)); 

        }
        elseif(Storage::exists($path)){

            return File::move(storage_path('app'.DIRECTORY_SEPARATOR.$path) ,public_path($path));

        }

    }
    

}


















?>