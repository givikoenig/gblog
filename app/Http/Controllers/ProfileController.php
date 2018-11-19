<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\WidgetRepository;
use App\Repositories\PblRepository;

use DB;
use Image;
use Session;
use App\User;

class ProfileController extends Controller
{

	protected $w_rep;
    
	public function __construct(WidgetRepository $w_rep, PblRepository $p_rep) {
        $this->w_rep = $w_rep;
		$this->p_rep = $p_rep;
	}

    public function profile(){
        $this->title = FALSE;
        $this->meta_desc = FALSE;
        $this->keywords = FALSE;

        /** ==== массив коллекций всех тегов модели Post   ======*/
        $alltags = $this->w_rep->getAllTags();
        /** ==== end Of массив коллекций всех тегов модели Post   ======*/
        /** ===== данные для раздела "Последние статьи" сайдбара ===== */
        $lasts = $this->w_rep->getLastPosts();
        /** ===== End Of данные для раздела "Последние статьи" сайдбара ===== */
        /** ==== массив коллекций всех комментариев к постам (для виджета last comments)======*/
        $lastcomments = $this->w_rep->getLastComments();
        /** ==== End Of массив коллекций всех комментариев к постам ======*/

    	if (Auth::check()) {

            $user = Auth::user();
            $this->title = 'Профиль ' . $user->name;
            $data = $this->p_rep->getData($this->title,$this->meta_desc,$this->keywords);
            $likescount = DB::table('laravellikecomment_likes')->where('user_id', $user->id)->count();
            $commentscount = DB::table('laravellikecomment_comments')->where('user_id', $user->id)->count();

            return view('users.profile', $data, [
                'user' => $user,
                'alltags' => $alltags,
                'lasts' => $lasts,
                'lastcomments' => $lastcomments,
                'likescount' => $likescount,
                'commentscount' => $commentscount,
            ]);
        } 
        return redirect()->route('login');
//      abort(401);
    }

    public function update_profile(Request $request) {
    	if($request->hasFile('avatar')){

    		$avatar = $request->file('avatar');
    		$filename = $avatar->getClientOriginalName(); // time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->fit(292,188)->save( public_path() . '/assets/img/post/' . $filename );
    		$user = Auth::user();

    		User::where('id', $user->id)->update(['avatar' => $filename]);
    		Session::flash('message', "Данные успешно сохранены!");
    		return redirect()->back();
    	}
    }

}
