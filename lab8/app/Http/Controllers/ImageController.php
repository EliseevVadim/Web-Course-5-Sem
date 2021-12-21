<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage() {
        session_start();
        $file = $_FILES['file'];
        $image = new Image($file, $_SESSION['id'], 0, null, null);
        $image->uploadToServer();
        $_FILES['file'] = null;
        return redirect()->route('upload');
    }

    public function viewPhoto($id) {
        $image = new Image($id);
        $image->increaseViewsCount();
        return redirect()->route('photo', $id);
    }

    public function openPhotoPage($id) {
        $photo = Image::prepareImageToShow($id);
        $comments = Comment::getCommentsForPicture($id);
        return view('photo', ['photo' => $photo, 'comments' => $comments]);
    }

    public function openEditingPage($id) {
        $photo = Image::prepareImageToShow($id);
        return view('edit', ['photo' => $photo]);
    }

    public function editPicture($id) {
        if (!empty($_POST['alt']) || !empty(($_POST['title']))) {
            $alt = $_POST['alt'];
            $title = $_POST['title'];
            $image = new Image($id, $alt, $title);
            $image->updateInDatabase();
            return redirect()->route('home');
        }
        return redirect()->route('edit', $id);
    }
}
