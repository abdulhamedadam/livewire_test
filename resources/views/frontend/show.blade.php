@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">Create new Post</p>
                    <a href="{{route('posts.index')}}" class="btn btn-sm btn-primary">Posts</a>
                </div>
                    <div class="card-body">
                        @if($post->image !=" ")
                            <div class=" col-md-2 form-group">
                                <img src="{{ asset('assests/'.$post->image) }}" alt="{{$post->title}}" class="img-fluid" style="max-width: 100% ">

                            </div>

                        @endif
                       <div class="col-12 justify-content-center pt-5">
                           <h3>{{$post->title}}</h3>
                           <small>{{$post->category->name}} By: {{$post->user->name}}</small>
                           <p>{{$post->body}}</p>
                       </div>



                    </div>


            </div>

        </div>
    </div>


@endsection
