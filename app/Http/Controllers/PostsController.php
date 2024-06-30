<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = Post::with('user', 'category')->orderBy('id', 'desc')->paginate(5);
        //dd($data);
        return view('frontend.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('frontend.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator])->withInput();
        }

        $data['title'] = $request->title;
        $data['category_id'] = $request->category;
        $data['user_id'] = auth()->id();
        $data['body'] = $request->body;

        if ($image = $request->file('image')) {
            $file_name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $path = public_path('/assests/' . $file_name);
            Image::make($image->getRealPath())->save($path, 100);
            $data['image'] = $file_name;
        }
        Post::create($data);
        return redirect()->route('posts.index')->with([
            'message' => 'post created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data['post'] = Post::with(['user', 'category'])->whereId($id)->first();
        if ($data['post']) {
            return view('frontend.show', $data);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'you have not permission to continue this process',
            'alert_type' => 'danger'
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['post'] = Post::whereId($id)->first();
        if ($data['post']) {
            $data['categories'] = Category::all();
            return view('frontend.edit', $data);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'you have not permission to continue this process',
            'alert_type' => 'danger'
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator])->withInput();
        }

        $post = Post::whereId($id)->first();
        if ($post) {
            $data['title'] = $request->title;
            $data['category_id'] = $request->category;
            $data['body'] = $request->body;

            if ($image = $request->file('image')) {
                if (File::exists('assests/' . $post->image)) {
                    unlink('assests' . $post->image);
                }
                $file_name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
                $path = public_path('/assests/' . $file_name);
                Image::make($image->getRealPath())->save($path, 100);
                $data['image'] = $file_name;
            }
            $post->update($data);
            return redirect()->route('posts.index')->with([
                'message' => 'post updated successfully',
                'alert_type' => 'success'
            ]);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'you have not permission to continue this process',
            'alert_type' => 'danger'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $post = Post::whereId($id)->first();
        if ($post) {
            if ($post->image != " ") {
                if (File::exists('assests/' . $post->image)) {
                    unlink('assests' . $post->image);
                }
            }
            $post->delete();
            return redirect()->route('posts.index')->with([
                'message' => 'post deleted successfully',
                'alert_type' => 'success'
            ]);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'you have not permission to continue this process',
            'alert_type' => 'danger'
        ]);

    }


    /********************************************/
    public function index_livewire()
    {
       return view('frontend.index_livewire');
    }
}
