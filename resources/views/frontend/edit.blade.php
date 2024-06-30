@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">Create new Post</p>
                    <a href="{{route('posts.index')}}" class="btn btn-sm btn-primary">Posts</a>
                </div>

                <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" value="{{old('title',$post->title)}}"
                                       class="form-control">
                                @error('title') <span class="text-danger">{{$message}}</span> @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-select">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category',$post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if($post->image !=" ")
                             <div class=" col-md-2 form-group">
                                 <img src="{{ asset('assests/'.$post->image) }}" alt="{{$post->title}}" width="100px">

                             </div>

                            @endif

                            <div class="col-md-@if($post->image !=" ") 2 @else 4 @endif form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" value="{{old('image')}}"
                                       class="form-control custom-file">
                                @error('image') <span class="text-danger">{{$message}}</span> @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="title">body</label>
                                <textarea type="text" id="body" name="body" rows="5" class="form-control">
                                  {{old('body',$post->body)}}
                                </textarea>
                                @error('body') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endsection
