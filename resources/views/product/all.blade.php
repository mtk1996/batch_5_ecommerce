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

        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card w-100 p-4">
                        <form>
                            <select name="category" class="btn btn-dark" id="">
                                <option value="">choose category</option>
                                @foreach ($category as $data)
                                <option value="{{$data->slug}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            <select name="" class="btn  btn-dark" id="">
                                <option value="">Color</option>
                            </select>
                            <select name="brand" class="btn  btn-dark" id="">
                                <option value="">choose brand</option>
                                @foreach ($brand as $data)
                                <option value="{{$data->slug}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="btn  btn-white" placeholder="enter search" name="name" id="">
                            <input type="submit" class="btn  bg-primary" value="search" name="" id="">

                            @if(request()->has('category'))
                            <a href="{{url('/products')}}" class="btn  btn-danger">Clear</a>
                            @endif
                        </form>
                    </div>
                </div>


                <!-- products -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    <div class="row">
                        <!-- loop product -->
                        @foreach ($product as $sProduct)
                        <div class="col-12 col-md-4 text-center mt-2">
                            <a href="{{url('/product/'.$sProduct->slug)}}">
                                <div class="card p-2">
                                    <img src="{{asset($sProduct->image_url)}}" alt="" class="w-100">
                                    <b>{{$sProduct->name}}</b>
                                    <div>
                                        <small class=" badge badge-danger">
                                            <strike>{{$sProduct->discounted_price}}ks</strike> </small>
                                        <small class="badge bg-primary">{{$sProduct->sale_price}}ks</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach


                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    {{$product->links()}}
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
