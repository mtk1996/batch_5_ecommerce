@extends('layout.master')

@section('content')
<!-- category list -->
<div class="w-80 mt-5">
    <div class="row mt-2">

        <!-- loop category -->
        @foreach ($category as $sCategory)
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 border">
            <a href="{{url('/products?category='.$sCategory->slug)}}" class="text-dark">
                <div class="d-flex justify-content-around align-items-center p-3">
                    <img src="{{asset($sCategory->image_url)}}" width="100" alt="">
                    <div class="text-center">
                        <p class="fs-2">{{$sCategory->name}}</p>
                        <small class="">{{$sCategory->product_count}} items</small>
                    </div>
                </div>
            </a>

        </div>
        @endforeach
    </div>
</div>

<div class="w-80 mt-5">

    <div class="row">

        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
            <a href="">
                <div class="border bg-warning p-5 text-center rounded">
                    <img src="/assets/images/product1.jpeg" class="w-80 margin-auto  rounded" alt="">
                    <div class="mt-5">
                        <h4 class="text-center mt-4 text-white">စားအုန်းဆီ အစစ်</h4>
                        <span class="text badge badge-white">10000ks</span>
                        <span class="text badge badge-danger"><strike>12000ks</strike></span>
                    </div>
                </div>
            </a>


            <div class="border bg-primary p-5 text-center rounded">
                <img src="/assets/images/product2.jpeg" class="w-80 margin-auto  rounded" alt="">
                <div class="mt-5">
                    <h4 class="text-center mt-4 text-white">Speaker</h4>
                    <span class="text badge badge-white">10000ks</span>
                    <span class="text badge badge-danger"><strike>12000ks</strike></span>
                </div>
            </div>

        </div>

        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <!-- products -->
                @foreach ($category_product as $cp)
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3 product">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <b class="fs-1">{{$cp->name}}</b>
                                <a href="{{url('/products?category='.$cp->slug)}}" class="btn btn-warning">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- loop product -->
                        @foreach ($cp->product as $sProduct )
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
