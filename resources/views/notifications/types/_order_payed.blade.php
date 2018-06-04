<div class="newslist">
    <span >{{$notification->created_at->diffForHumans()}}</span>
    <p >{{ $notification->data['message'] }}</p>
    <p>订单名称：{{ $notification->data['order_name'] }}</p>
    <p>订单号：{{ $notification->data['order_sn'] }}</p>
    <p>取货点：{{ $notification->data['depot'] }}</p>
    <a href="{{ $notification->data['order_link'] }}">查看订单</a>
</div>