<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	//
    public function index(){
		$title = "The Hom of Blues";
		//	return view('pages.index', compact('title'));
		return view('pages.index')->with('title', $title);
    }

    public function about(){
	$title = "about page is really ";
	    return view('pages.about')->with('title', $title);
    }

    public function services(){
	$data = array (
	    'title' => 'Services',
	    'services' => ['web','mobile', 'career coach'],
	    'location' => 'Cleveland'
	);
	return view('pages.services')->with( $data);
    }    
}
