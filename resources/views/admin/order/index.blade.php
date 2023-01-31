@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('category.create')}}" class="btn btn-success">Create</a>
    <a href="?status=pending" class="btn btn-success">Pending Order</a>
    <a href="?status=reject" class="btn btn-success">Reject Order</a>
    <a href="?status=success" class="btn btn-success">Success Order</a>
    <a href="{{url('/admin/order')}}" class="btn btn-success">view all</a>
</div>

<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Payment Info</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $sOrder)
        <tr>
            <td>
                <img src="{{$sOrder->product->image_url}}" alt="" style="width: 70px">
            </td>
            <td>{{$sOrder->product->name}}</td>
            <td>
                {{$sOrder->stock_qty}}
            </td>
            <td>
                <table class="table table-striped">
                    <tr>
                        <td>
                            <small>Phone</small>
                        </td>
                        <td>
                            <small>Shipping Address</small>
                        </td>
                        <td>
                            <small>payment Screenshot</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>{{$sOrder->phone}}</small>
                        </td>
                        <td>
                            <small>
                                {{$sOrder->shipping_address}}
                            </small>
                        </td>
                        <td>
                            <img src="{{ asset('/images/'.$sOrder->payment_screenshot)}}" style="width: 50%">
                        </td>
                    </tr>
                </table>
            </td>

            <td>
                @if($sOrder->status=='success')
                <small class="text-success">Order Success</small>
                @endif
                @if($sOrder->status=='reject')
                <small class="text-danger">Order Rejected</small>
                @endif


                @if($sOrder->status=='pending')
                <a href="{{url('/admin/order-status?status=success&id='.$sOrder->id)}}"
                    class="btn btn-success btn-sm">Success</a>
                <a href="{{url('/admin/order-status?status=reject&id='.$sOrder->id)}}"
                    class="btn btn-danger btn-sm">Reject</a>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$order->links()}}
@endsection
