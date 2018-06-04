<div class="newslist">
    <span >{{$notification->created_at->diffForHumans()}}</span>
    <p >{{ $notification->data['message'] }}</p>
    <a href="{{ $notification->data['order_link'] }}">查看订单</a>
</div>