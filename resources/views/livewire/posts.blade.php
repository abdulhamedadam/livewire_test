@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">Posts</p>
                    <a href="javascript:void(0);"  wire:click="create_post()" class="btn btn-sm btn-primary">Create Post</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td><img src="{{ asset('assests/'.$post->image) }}" alt="{{$post->title}}" width="100px"></td>
                                    <td><a href="javascript:void(0);" wire:click="show_post({{$post->id}})" >{{$post->title}}</a></td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>
                                        <a href="javascript:void(0);" wire:click="edit_post({{$post->id}})"  class="btn btn-sm btn-warning">Edit</a>
                                        <a href="javascript:void(0)" wire:click="delete_post({{$post->id}})" onclick="confirm('are you sure!?');return false" class="btn btn-sm btn-danger">Delete</a>

                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="float-right">
                    {{ $posts->links() }}
                </div>


            </div>
        </div>

    </div>


@endsection
