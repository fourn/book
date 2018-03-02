@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Book
                    <a class="btn btn-success pull-right" href="{{ route('books.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($books->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Sn</th> <th>Name</th> <th>Image</th> <th>Author</th> <th>Press</th> <th>Published_at</th> <th>Used</th> <th>Original_price</th> <th>Price</th> <th>Description</th> <th>Status</th> <th>Is_show</th> <th>Is_recommend</th> <th>User_id</th> <th>Category_id</th> <th>School_id</th> <th>Admin_id</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td class="text-center"><strong>{{$book->id}}</strong></td>

                                    <td>{{$book->sn}}</td> <td>{{$book->name}}</td> <td>{{$book->image}}</td> <td>{{$book->author}}</td> <td>{{$book->press}}</td> <td>{{$book->published_at}}</td> <td>{{$book->used}}</td> <td>{{$book->original_price}}</td> <td>{{$book->price}}</td> <td>{{$book->description}}</td> <td>{{$book->status}}</td> <td>{{$book->is_show}}</td> <td>{{$book->is_recommend}}</td> <td>{{$book->user_id}}</td> <td>{{$book->category_id}}</td> <td>{{$book->school_id}}</td> <td>{{$book->admin_id}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('books.show', $book->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('books.edit', $book->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $books->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection