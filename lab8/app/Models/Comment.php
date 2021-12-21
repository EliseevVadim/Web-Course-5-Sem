<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    private $id;
    private $author;
    private $content;
    private $imageId;

    public function __construct()
    {
        $params = func_get_args();
        $number = func_num_args();
        switch ($number) {
            case 3:
                $this->author = $params[0];
                $this->content = $params[1];
                $this->imageId = $params[2];
                break;
            case 4:
                $this->author = $params[0];
                $this->content = $params[1];
                $this->imageId = $params[2];
                $this->id = $params[3];
                break;
            default:
                throw new \InvalidArgumentException();
        }
    }

    public static function getCommentsForPicture($imageId): array
    {
        $comments = DB::table('comment')->select('author', 'content')
            ->where('ImageId', $imageId)
            ->get();
        return $comments->all();
    }

    public static function getCommentById($id): array
    {
        $comment = DB::table('comment')->select('id', 'Author', 'Content')
            ->where('id', $id)
            ->get();
        return $comment->all();
    }

    public static function getAllComments(): array
    {
        $comments = DB::table('comment')->select('id', 'ImageId', 'Author', 'Content')
            ->get();
        return $comments->all();
    }

    public function addToDatabase() {
        DB::insert('insert into comment (ImageId, Author, Content) values (?, ?, ?)', [$this->imageId,
            $this->author, $this->content]);
    }

    public function updateInDatabase() {
        $rows = DB::update('update comment set Author = :author, Content = :content where id = :id',
        ['author' => $this->author, 'content' => $this->content, 'id' => $this->id]);
    }
}
