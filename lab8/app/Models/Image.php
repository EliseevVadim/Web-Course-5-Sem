<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Exception;

class Image extends Model
{
    private $id;
    private $file;
    private $authorsId;
    private $title;
    private $alt;
    private $name;
    private $views;

    public function __construct()
    {
        $params = func_get_args();
        $number = func_num_args();
        switch ($number) {
            case 1:
                $this->id = $params[0];
                break;
            case 3:
                $this->id = $params[0];
                $this->alt = $params[1];
                $this->title = $params[2];
                break;
            case 5:
                $this->file = $params[0];
                $this->authorsId = $params[1];
                $this->views = $params[2];
                $this->title = $params[3];
                $this->alt = $params[4];
                break;
            default:
                throw new \InvalidArgumentException();
        }
    }

    private function getExtension() : string {
        $parts = explode('.', $this->file['name']);
        return strtolower(end($parts));
    }

    private function isValid() : bool {
        $allowedExtensions = ["jpg", "png", "webp", "jpeg", "gif", "bmp"];
        if($this->file['name'] === '') {
            $_SESSION['upload_message'] = "Файл не выбран";
            return false;
        }
        if($this->file['size'] === 0) {
            $_SESSION['upload_message'] = "Файл невозможно загрузить";
            return false;
        }
        $extension = $this->getExtension();
        if(!in_array($extension, $allowedExtensions)) {
            $_SESSION['upload_message'] = "Загружаемый файл не является изображением";
            return false;
        }
        return true;
    }

    private function resizeImage($name, $requiredHeight) {
        $previewsDirectory = public_path().'/uploads/small_images/';
        $sourceImage = match ($this->file['type']) {
            'image/jpeg' => imagecreatefromjpeg($this->file['tmp_name']),
            'image/gif' => imagecreatefromgif($this->file['tmp_name']),
            'image/png' => imagecreatefrompng($this->file['tmp_name']),
            'image/webp' => imagecreatefromwebp($this->file['tmp_name']),
            'image/bmp' => imagecreatefrombmp($this->file['tmp_name']),
        };
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        $scaleCoefficient = $requiredHeight / $sourceHeight;
        $newWidth = round($sourceWidth * $scaleCoefficient);
        $newHeight = round($sourceHeight * $scaleCoefficient);
        $resultImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resultImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
        imagejpeg($resultImage, $previewsDirectory.$name, 100);
    }

    private function upload() : string {
        $directory = public_path().'/uploads/original_images/';
        $newName = uniqid();
        $extension = $this->getExtension();
        copy($this->file['tmp_name'], $directory.$newName.".".$extension);
        $this->resizeImage($newName.".".$extension, 150);
        return $newName.".".$extension;
    }

    public function uploadToServer() {
        if ($this->isValid()) {
            $oldName = $this->file['name'];
            $this->name = $this->upload();
            $_SESSION['upload_message'] = "<div id=\"result-area\">
                                <div class=\"info-record\">
                                    <span>Был загружен файл: </span>
                                    <span class='value'>$oldName</span>
                                </div>
                                <div class=\"info-record\">
                                    <span>Под именем: </span>
                                    <span class='value'>$this->name</span>
                                </div>
                              </div>";
            $this->addToDatabase();
        }
    }

    public static function getAllImages(): array
    {
        $images = DB::table('image')->select('id', 'AuthorId', 'Path', 'Views', 'Title', 'Alt')
            ->orderBy('Views', 'desc')
            ->get();
        return $images->all();
    }

    public static function prepareImageToShow($id)
    {
        try {
            $image = DB::table('image')->select('id', 'AuthorId', 'Path', 'Views', 'Title', 'Alt')
                ->where('id', $id)
                ->get();
            $resultArray = $image->all()[0];
            $author = DB::table('User')->where('id', $resultArray->AuthorId)->value('Name');
            $resultArray->author = $author;
            return $resultArray;
        }
        catch (\Exception $ex) {
            die('<h1>Такого изображения не существует</h1>');
        }
    }

    public function increaseViewsCount() {
        try {
            DB::update('update image set views = views + 1 where id = :id', ['id' => $this->id]);
        }
        catch (Exception $ex) {
            die('<h1>Такого изображения не существует</h1>');
        }
    }

    private function addToDatabase() {
        DB::insert('insert into image (AuthorId, Path) values (?, ?)', [$this->authorsId, $this->name]);
    }

    public function updateInDatabase() {
        DB::update('update image set Title = :title, Alt = :alt where id=:id',
            ['id' => $this->id, 'title' => $this->title, 'alt' => $this->alt]);
    }
}
