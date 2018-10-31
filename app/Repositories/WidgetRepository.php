<?php

namespace App\Repositories;

use risul\LaravelLikeComment\Models\Comment;
use App\Post;
use App\Tag;

class WidgetRepository {

	public function getLastComments () {
        $lastcomments = Comment::latest()->take(4)->get();
        return $lastcomments;
    }

    public function getAllTags () {
        $alltags = Tag::all();
        return $alltags;
    }
    public function getLastPosts () {
        $lasts = Post::latest()->get()->take(4);
        return $lasts;
    }

}

?>