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
        //dd($request->article_id);
        //$new_comment = new Comment;
        //$new_comment->article_id = $request->article_id; 
        //$new_comment->content = $request->content; 
        //if ($request->user == "") {
        //    $new_comment->user = Session::get('user_name'); 
        //} else {
        //    $new_comment->user = $request->user;  
        //}
        //$new_comment->save();
        $comment_user = $request->user;
        $comment_content = $request->content;

        $validate = Validator::make($request->all(), comment::valid());
        if ($validate->fails()) {
            $flash = "Fails, check your input!!";
            $status = "Failed";
        } else {
            Comment::create($request->all());
            $flash = "Comment added succesfuly";
            $status = "Success";
            //Session::flash('notice','Comment added succesfuly');
           // return Redirect::to('articles/'.$request->article_id);
            //return redirect()->route('articles.show',$request->article_id);
        }
        return response()->json(['flash' => $flash, 'user' => $comment_user, 'content' => $comment_content, 'status' => $status]);

        //$comments = Comment::where('article_id',$request->article_id)->orderBy('created_at','DESC')->get();
        //dd($comments);
        
        //$view = (String) view('articles.ajax_comment')->with('comments', $comments);
        //return view('articles.ajax_comment')->with('comments',$comments);
    }
}
