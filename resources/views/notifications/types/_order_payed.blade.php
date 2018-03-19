<div class="newslist">
    {{ $notification->data['message'] }}
    <br>
    订单名称：{{ $notification->data['order_name'] }}
    <br>
    订单号：{{ $notification->data['order_sn'] }}
    <br>
    取货点：{{ $notification->data['depot'] }}
    <a href="{{ $notification->data['order_link'] }}">查看订单>></a>
    <p class="p2">{{ $notification->created_at->diffForHumans() }}</p>
</div>