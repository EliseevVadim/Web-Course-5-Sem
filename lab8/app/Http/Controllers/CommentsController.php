<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function leaveComment($id) {
        $author = $_POST['author'];
        $content = $_POST['content'];
        $comment = new Comment($author, $content, $id);
        $comment->addToDatabase();
        return redirect()->route('photo', $id);
    }

    public function updateComment($id) {
        $author = $_POST['author'];
        $content = $_POST['content'];
        $comment = new Comment($author, $content, null, (int)$id);
        try {
            $comment->updateInDatabase();
            return redirect()->route('tables');
        }
        catch (\Exception $ex) {
            die($ex->getMessage());
        }
        dd($comment);
    }
}
