@extends('layout.master')

@section('content')

<div class="w-80 mt-5">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
            <div class="card">
                <div class="card-header bg-dark text-white">All Category</div>
                @foreach ($category as $c )
                <a class="text-dark" href="{{url('/products?category='.$c->slug)}}">
                    <li class="list-group-item">
                        <img src="{{$c->image_url}}" width="30" alt="">
                        {{$c->name}}
                        <small class="float-right badge badge-dark">{{$c->product_count}}</small>
                    </li>
                </a>
                @endforeach
            </div>

            {{-- brand --}}
            <div class="card">
                <div class="card-header bg-dark text-white">All Brand</div>
                @foreach ($brand as $c )
                <a class="text-dark" href="{{url('/products?brand='.$c->slug)}}">
                    <li class="list-group-item">
                        {{$c->name}}
                        <small class="float-right badge badge-dark">{{$c->product_count}}</small>
                    </li>
                </a>
                @endforeach
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-9 col-lg-9" id="root">
            {{-- react component --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('/js/ProductDetail.js')}}"></script>
@endsection
