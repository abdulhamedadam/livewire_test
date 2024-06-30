<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    //use WithPagination;
    public function render()
    {
        $data['posts']=Post::with(['user','category'])->orderBy('id','desc')->paginate(5);
        return view('livewire.posts',$data);
    }


    public function create_post(){
        return redirect()->to('/livewire/posts/create');
    }


    public function edit_post($id){

    }


    public function show_post($id){

    }


    public function delete_post($id){

    }




}
