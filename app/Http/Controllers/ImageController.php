<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article, App\Image;
use App\Http\Requests\ArticleRequest;
use Session;
use File;

class ImageController extends Controller
{
    public function show_img($id)
    {
        
        $img = Image::find($id);
        return view('articles.showImage')->with('img',$img);
    }
}
