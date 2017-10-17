<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use Redirect;
use App\Comment, App\Article;

class CommentsController extends Controller
{
    function __contsruct(){
        parent::__construct();
        Session::set('user_name','admin');
    }


    public function store(Request $request) {
        $new_comment = new Comment;
        $new_comment->article_id = $request->article_id; 
        $new_comment->content = $request->content; 
        if ($request->user == "") {
            $new_comment->user = Session::get('user_name'); 
        } else {
            $new_comment->user = $request->user; 
            
        }

        $validate = Validator::make($request->all(), comment::valid());
        if ($validate->fails()) {
            return Redirect::to('articles/'.$request->article_id)
            ->withErrors($validate)
            ->withInput();
        } else {
            $new_comment->save();
            Session::flash('notice','Comment added succesfuly');
           // return Redirect::to('articles/'.$request->article_id);
            return redirect()->route('articles.show',$request->article_id);
        }
    }
}
