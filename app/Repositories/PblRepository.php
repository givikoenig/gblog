<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class PblRepository {

	public function getData($title = FALSE, $meta_desc = FALSE, $keywords = FALSE, $image = FALSE, $desc = FALSE) {


		$data = [
				'title' => $title,
				'meta_desc' => $meta_desc,
                'keywords' => $keywords,
                'image' => $image,
                'desc' => $desc,
            ];
        return $data;

	}

	public function getArrayIdFieldFromCollection($collection = FALSE, $field = FALSE) {

		$arr = [];
		foreach ($collection as $item) {
			$arr[$item->id] = $item->$field;
		}

		return $arr;

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
		
		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);
		
		$str = trim($str,'-');
		
		return $str;
	}

}


?>