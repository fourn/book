@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Book /
                    @if($book->id)
                        Edit #{{$book->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($book->id)
                    <form action="{{ route('books.update', $book->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('books.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="sn-field">Sn</label>
                	<input class="form-control" type="text" name="sn" id="sn-field" value="{{ old('sn', $book->sn ) }}" />
                </div> 
                <div class="form-group">
                	<label for="name-field">Name</label>
                	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $book->name ) }}" />
                </div> 
                <div class="form-group">
                	<label for="image-field">Image</label>
                	<textarea name="image" id="image-field" class="form-control" rows="3">{{ old('image', $book->image ) }}</textarea>
                </div> 
                <div class="form-group">
                	<label for="author-field">Author</label>
                	<input class="form-control" type="text" name="author" id="author-field" value="{{ old('author', $book->author ) }}" />
                </div> 
                <div class="form-group">
                	<label for="press-field">Press</label>
                	<input class="form-control" type="text" name="press" id="press-field" value="{{ old('press', $book->press ) }}" />
                </div> 
                <div class="form-group">
                    <label for="published_at-field">Published_at</label>
                    <input class="form-control" type="text" name="published_at" id="published_at-field" value="{{ old('published_at', $book->published_at ) }}" />
                </div> 
                <div class="form-group">
                	<label for="used-field">Used</label>
                	<input class="form-control" type="text" name="used" id="used-field" value="{{ old('used', $book->used ) }}" />
                </div> 
                <div class="form-group">
                    <label for="original_price-field">Original_price</label>
                    <input class="form-control" type="text" name="original_price" id="original_price-field" value="{{ old('original_price', $book->original_price ) }}" />
                </div> 
                <div class="form-group">
                    <label for="price-field">Price</label>
                    <input class="form-control" type="text" name="price" id="price-field" value="{{ old('price', $book->price ) }}" />
                </div> 
                <div class="form-group">
                	<label for="description-field">Description</label>
                	<textarea name="description" id="description-field" class="form-control" rows="3">{{ old('description', $book->description ) }}</textarea>
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $book->status ) }}" />
                </div> 
                <div class="form-group">
                    <label for="is_show-field">Is_show</label>
                    <input class="form-control" type="text" name="is_show" id="is_show-field" value="{{ old('is_show', $book->is_show ) }}" />
                </div> 
                <div class="form-group">
                    <label for="is_recommend-field">Is_recommend</label>
                    <input class="form-control" type="text" name="is_recommend" id="is_recommend-field" value="{{ old('is_recommend', $book->is_recommend ) }}" />
                </div> 
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $book->user_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="category_id-field">Category_id</label>
                    <input class="form-control" type="text" name="category_id" id="category_id-field" value="{{ old('category_id', $book->category_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="school_id-field">School_id</label>
                    <input class="form-control" type="text" name="school_id" id="school_id-field" value="{{ old('school_id', $book->school_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="admin_id-field">Admin_id</label>
                    <input class="form-control" type="text" name="admin_id" id="admin_id-field" value="{{ old('admin_id', $book->admin_id ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('books.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection