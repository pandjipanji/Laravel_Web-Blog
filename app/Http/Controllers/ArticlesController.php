<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article, App\Image;
use App\Http\Requests\ArticleRequest;
use Session;
use File;

class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('sentinel');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $articles = Article::all();
        return view('articles.index')->with('articles',$articles); //CARA 1

        //return view('articles.index', compact('articles'));  //CARA 2

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = true;
        return view('articles.create')->with('create',$create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
       $articles =  Article::create($request->all());
       $destination_path = "uploads/";
       foreach ($request->image as $image) {
           $name = str_random(6).'_'.$image->getClientOriginalName();
           $image->move($destination_path,$name);
            Image::create([
                'article_id' => $articles->id,
                'image' => $destination_path.$name
            ]);
       }
        if ($articles) {
            Session::flash("notice","Article Created Succesfully");
            return redirect()->route("articles.index");
        } else {
            Session::flash("error","Failed to create Article!!");
            return redirect()->route("articles.index");
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('comment.created_at');
        $images = Article::find($id)->images->sortBy('image.id');

        return view('articles.show')
        ->with('article',$article)
        ->with('comments',$comments)
        ->with('images',$images);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $create = false;
        return view('articles.edit', compact('article','create'));        
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $articles =  Article::find($id)->update($request->all());
       if ($articles) {
            Session::flash("notice","Article Updated!!");
            return redirect()->route('articles.show',$id);
       } else {
            Session::flash("error","Failed to update!!");
            return redirect()->route('articles.show',$id);
       }
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $img_data = Image::where('article_id',$id)->get();
            if ($img_data != null) {
                foreach ($img_data as $img) {
                    File::delete($img->image);
                }
                Image::where('article_id',$id)->delete();
            }

            Article::destroy($id);
            Session::flash("notice","Article Deleted");
            return redirect()->route('articles.index');
        }
        catch(\Exception $e) {
            Session::flash("error","Whoops something went wrong, failed to delete!!");
            return redirect()->route('articles.index');
        }

        
    }

    public function show_img($id)
    {
        
        $img = Image::find($id);
        return view('articles.showImage')->with('img',$img);
    }

    public function update_img(Request $request, $id)
    {
        $img =  Image::find($id);
            File::delete($img->image);//deleting the image first
        $destination_path = "uploads/";
        $name = str_random(6).'_'.$request->image->getClientOriginalName();
        $request->image->move($destination_path,$name);
        $update = Image::find($id)->update([
                 'image' => $destination_path.$name
             ]);
        if ($update) {
            Session::flash("notice","Image Updated");
            return redirect()->route('articles.show',$img->article_id);
       } else {
            Session::flash("error","Failed to update image!!");
            return redirect()->route('articles.show',$img_article_id);
       }
        
    }

    public function delete_img($id)
    {
        $img_data = Image::find($id);

        try{
            File::delete($img_data->image);//deleting the image
            Image::destroy($id);
            Session::flash("notice","Image Deleted");
            return redirect()->route('articles.show',$img_data->article_id);
        }
        catch(\Exception $e){
            return redirect()->route('articles.show',$img_data->article_id);
        }
    }
}
