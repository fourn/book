@if(count($books))
    @foreach ($books as $book)
    <a class="prolist" href="{{ route('books.show', [$book->id]) }}">
        <div class="box">
            <i style="background-image: url({{ $book->image }})"></i>
            <p class="p1">{{ $book->name }}</p>
            <p class="p2">{{ $book->author }}<span>{{ $book->press }}</span></p>
            <p class="p3">￥{{ $book->price }}<span>￥{{ $book->original_price }}</span></p>
            <p class="p4">
                <span class="sp1">{{ $book->published_at }}年出版</span><span class="sp2">{{ $book->used }}</span>
            </p>
        </div>
    </a>
    @endforeach
@endif