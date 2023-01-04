@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-header bg-dark text-white p-4 text-center m-0">
                Please Register
            </div>
            <div class="card-body">
                {{-- error --}}
                @if($errors->any())
                @foreach ($errors->all() as $e)
                <div class="alert alert-danger">{{$e}}</div>
                @endforeach
                @endif


                <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <input type="submit" value="Register" class="btn btn-block btn-dark">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
