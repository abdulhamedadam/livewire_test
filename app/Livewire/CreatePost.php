<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Image;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $title;
    public $category;
    public $image;
    public $body;



    public function render()
    {
        $data['categories'] = Category::all();
        return view('livewire.create-post', $data);
    }

    public function return_to_post()
    {
        return redirect()->to('/livewire/posts');
    }

    public function save()
    {
         $this->validate([
             'title' => 'required|max:255',
             'body' => 'required',
             'category' => 'required|exists:categories,id',
           //  'image' => 'nullable|image|mimes:jpg,jpeg,gif,png|max:2048',
         ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['title'] = $this->title;
        $validatedData['category_id'] = $this->category;
        $validatedData['body'] = $this->body;

        if ($this->image) {
            $fileName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
            $path = public_path('/assets/' . $fileName);
           Image::make($this->image->getRealPath())->save($path, 100);
            $validatedData['image'] = $fileName;
        }

        Post::create($validatedData);
        $this->resetInputs();
        session()->flash('message', 'Post created successfully.');
        return redirect()->to('/livewire/posts');
    }

    private function resetInputs()
    {
        $this->title = null;
        $this->category = null;
        $this->body = null;
        $this->image = null;
    }
}
