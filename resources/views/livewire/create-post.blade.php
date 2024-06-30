@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">Create new Post</p>
                    <a href="javascript:void(0);" wire:click="return_to_post()" class="btn btn-sm btn-primary">Posts</a>
                </div>

                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert_session">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session()->has('message_error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert_session">
                                <strong>{{ session('message_error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" wire:model="title" class="form-control">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category" wire:model="category" class="form-select">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($categories as $category)
                                        <option wire:key="{{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" wire:model="image" class="form-control">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="body">Body</label>
                                <textarea id="body" wire:model="body" rows="5" class="form-control"></textarea>
                                @error('body') <span class="text-danger">{{ $message }}</span> @enderror
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
