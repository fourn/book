<div class="newslist">
    <span >{{$notification->created_at->diffForHumans()}}</span>
    <p >{{ $notification->data['message'] }}</p>
</div>