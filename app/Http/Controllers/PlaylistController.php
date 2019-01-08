<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Playlist;

class PlaylistController extends Controller
{
    public function getPlaylist()
    {
        $playlist_coll = Playlist::all(); //OrderBy('created_at', 'desc')->get();
        $result = [];
        foreach ($playlist_coll as $playlist) {
            $result[] = array(
                'type' => $playlist->type,
                'src' => $playlist->src,
                'descr' => $playlist->descr,
                'poster' => asset('assets') . '/img/post/' . $playlist->poster
            );
        }
        return $result;
    }
}
