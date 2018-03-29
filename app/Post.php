<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{

	protected $fillable = [ 'title', 'body', 'desc', 'alias', 'img', 'pictures', 'user_id'];
    //
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("desc", "LIKE", "%$keyword%")
                    ->orWhere("body", "LIKE", "%$keyword%")
                    ->orWhere("alias", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function setImgSlideAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['img_slide'] = json_encode($pictures);
        }
    }

    public function getImgSlideAttribute($pictures)
    {
        return json_decode($pictures, true);
    }

    public function getBodyAttribute($text)
    {
        return str_replace('&', '&amp;', $text);
    }

    public function setAliasAttribute()
    {
            $this->attributes['alias'] = $this->transliterate($this->attributes['title']);
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function posttype() {
    	return $this->belongsTo('App\PostType');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag'); //,'post_tag')->withPivot('post_id','tag_id');
    }

    public function transliterate($string) {
        $str = mb_strtolower($string, 'UTF-8');
        
        $leter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,є,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и,і',
            'ji' => 'ї',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );
        
        if(preg_match('/[^\\p{Common}\\p{Latin}]/u', $str)) {
            foreach($leter_array as $leter => $kyr) {
                $kyr = explode(',',$kyr);
                $str = str_replace($kyr,$leter, $str);
            }
        } 
        
        $str = preg_replace('/(\s|[^A-Za-z0-9])+/','-',$str);
        
        $str = trim($str,'-');
        
        return $str;
    }


}
