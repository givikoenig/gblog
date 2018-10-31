<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocketController extends Controller
{
	public function index() {
		return view('posts.socket');
	}

	public function newEvent(\Illuminate\Http\Request $request) {

    	$result = [
            'labels' => ['март', 'апрель', 'май', 'июнь'],
            'datasets' => array([
                'label' => 'Продажи',
				'backgroundColor' => '#F26202',
                'data' => [5000,18000,10000,30000],
            ]),
        ];

        if ($request->has('label')) {
        	$result['labels'][] = $request->input('label');
        	$result['datasets'][0]['data'][] = (integer)$request->input('sale');

        	if ($request->has('realtime')) {
	        	if ( $request->input('realtime') == "true" ) {
	        		event(new \App\Events\NewEvent($result));
	        	}
	        }

        }

        return $result;

    }

}
