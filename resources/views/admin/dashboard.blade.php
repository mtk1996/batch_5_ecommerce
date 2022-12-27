@extends('admin.layout.master')

@section('content')
<h1>admin dashboard</h1>
{{auth()->guard('admin')->user()}}
<button class="btn btn-success">tet</button>
@endsection
