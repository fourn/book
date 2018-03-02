@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Book / Show #{{ $book->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('books.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('books.edit', $book->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Sn</label>
<p>
	{{ $book->sn }}
</p> <label>Name</label>
<p>
	{{ $book->name }}
</p> <label>Image</label>
<p>
	{{ $book->image }}
</p> <label>Author</label>
<p>
	{{ $book->author }}
</p> <label>Press</label>
<p>
	{{ $book->press }}
</p> <label>Published_at</label>
<p>
	{{ $book->published_at }}
</p> <label>Used</label>
<p>
	{{ $book->used }}
</p> <label>Original_price</label>
<p>
	{{ $book->original_price }}
</p> <label>Price</label>
<p>
	{{ $book->price }}
</p> <label>Description</label>
<p>
	{{ $book->description }}
</p> <label>Status</label>
<p>
	{{ $book->status }}
</p> <label>Is_show</label>
<p>
	{{ $book->is_show }}
</p> <label>Is_recommend</label>
<p>
	{{ $book->is_recommend }}
</p> <label>User_id</label>
<p>
	{{ $book->user_id }}
</p> <label>Category_id</label>
<p>
	{{ $book->category_id }}
</p> <label>School_id</label>
<p>
	{{ $book->school_id }}
</p> <label>Admin_id</label>
<p>
	{{ $book->admin_id }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
