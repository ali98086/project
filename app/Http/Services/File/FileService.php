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

        $this->pathFile= $path;

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

        $fileName= $this->getNameFile();
        $save= Storage::putFileAs('files'.DIRECTORY_SEPARATOR.'notify'.DIRECTORY_SEPARATOR.'email-notify'.DIRECTORY_SEPARATOR , $file , $fileName);
        return $save ? true : false;

    }



    public function fullPath($place = 'public'){

        if($place != 'public'){

            return storage_path('files'.DIRECTORY_SEPARATOR.'notify'.DIRECTORY_SEPARATOR.'email-notify'.DIRECTORY_SEPARATOR.$this->getNameFile());

        }

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
    

}


















?>