<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
// use Spatie\Html\Html;
// use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function index()
    {
        // $post = Post::where('title','Post Two')->get();//using alequin query with the where clause
        // $posts = DB::select('SELECT * FROM posts');//normal sql query by using the DB class
        // $posts = Post::orderBy('title','desc')->take(2)->get();//chosing number of lines to show

        $posts = Post::orderBy('created_at','desc')->paginate(5);//displaying posts by latest
        return view('posts.index')->with('posts',$posts);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename using pathinfo which is a php method!
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
             
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //we have a link that allow us to access the directory below using this command $php artisan storage:link 
            //this dir public/cover_images contain the pictures
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		
	        // make thumbnails
	        // $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            // $thumb = Image::make($request->file('cover_image')->getRealPath());
            // $thumb->resize(80, 80);
            // $thumb->save('storage/cover_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        if($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        
        //check for correct user 
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		
	    // make thumbnails
	    // $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
        //     $thumb = Image::make($request->file('cover_image')->getRealPath());
        //     $thumb->resize(80, 80);
        //     $thumb->save('storage/cover_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Updating a post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        //checking for the correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error',"Unauthorized Page");
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('posts')->with('success', 'Post Removed');
        
    }
}
