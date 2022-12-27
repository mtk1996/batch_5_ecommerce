@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('product.index')}}" class="btn btn-dark">Back</a>
</div>

<form class="mt-3" action="{{route('product-transaction.store').'?pid='.$pid}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Choose Supplier</label>
        <select name="supplier_id" class="form-control">
            @foreach ($supplier as $sSupplier)
            <option value="{{$sSupplier->id}}">{{$sSupplier->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Enter Stock Quantity</label>
        <input type="number" name="stock_qty" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Enter Description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <input type="submit" value="Add" class="btn btn-dark">
</form>
@endsection
