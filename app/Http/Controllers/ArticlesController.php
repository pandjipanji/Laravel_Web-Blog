<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article, App\Image;
use App\Http\Requests\ArticleRequest;
use Session;
use File;
use Excel;
use DB;
use Illuminate\Support\Facades\Input;

class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('sentinel');
        $this->middleware('sentinel.role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
    {
        if($request->ajax()){
            //dd($request->keywords);
            $articles = Article::where('title', 'like', '%'.$request->keywords.'%')
                        ->orWhere('content', 'like', '%'.$request->keywords.'%');
            if($request->direction) {
                $articles = $articles->orderBy('id', $request->direction);
            }

            $articles = $articles->paginate(3);
            $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';
            $request->keywords == '' ? $keywords = '' : $keywords = $request->keywords;
            
            $view = (String) view('articles.list')
            ->with('articles', $articles)
            ->render();

            return response()->json(['view' => $view, 'direction' =>
            $direction, 'keywords' => $keywords, 'status' => 'success']);
        } else {
            //$articles = Article::all();
            $articles = Article::paginate(3);
            return view('articles.index')->with('articles',$articles); //CARA 1
            //return view('articles.index', compact('articles'));  //CARA 2 (bisa menampung lebih dari satu variabel)
        }
        
        

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

        try{
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
            Session::flash("notice","Article Created Succesfully");
            return redirect()->route("articles.index");
        } catch (\Exception $e) {
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
        $comments = Article::find($id)->comments->sortBy('created_at');
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

    public function export_all(){
        //$data = Article::get()->toArray();
        $data = Article::with('Images','comments')->get()->toArray();
        //dd($data);
        
        foreach ($data as $value) {
            $images = "";
            $comments = "";
            foreach ($value['images'] as $val) {
                //dd($value['image']);
                if ($images == "") {
                    $images = substr($val['image'],8);
                } else {
                    $images = $images." , ".substr($val['image'],8);
                }
            }

            foreach ($value['comments'] as $isi) {
                //dd($value['image']);
                if ($comments == "") {
                    $comments = $isi['user']." : ".$isi['content'];
                } else {
                    $comments = $comments." , ".$isi['user']." : ".$isi['content'];
                }
            }

            $view[] = [
                'id' => $value['id'],
                'title' => $value['title'], 
                'content' => $value['content'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'images' => $images,
                'comments' => $comments
            ];
        }
        //dd($view);
        //dd($images);
            Excel::create('Article Export', function($excel) use ($view){
                $excel->sheet('sheet1', function($sheet) use ($view) {
                    $sheet->cell('A1:G1', function($cells){
                        $cells->setBackground('#ebebeb');
                        $cells->setFontColor('#000000');
                        $cells->setFontWeight('bold');
                        $cells->setAlignment('center');
                    });

                    $sheet->fromArray($view);
                });
            })->export('xlsx');
    }

    public function import(Request $request){
        //$file = $request->import;
        //dd($file);
        $this->validate($request,[
            'import' => 'required|mimes:xlsx,xls',
        ]);
        
        //$file_name = $request->import->getClientOriginalName();
        $file_name = Input::file('import')->getRealPath();
        //dd($file_name);
        $data = Excel::load($file_name, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $val) {
					$insert[] = [
                        'title' => $val->title, 
                        'content' => $val->content,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
                //dd($insert);
				if(!empty($insert)){
                    //DB::table('articles')->insert($insert);
                    Article::insert($insert);
                    Session::flash('notice','Imported Successfuly');
                    return redirect()->route('articles.index');
                }
            }
            else {
                Session::flash('error','Fail to import');
                return redirect()->route('articles.index');
            } 
    }
}
