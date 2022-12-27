@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('category.create')}}" class="btn btn-success">Create</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)

        <tr>
            <td>
                <img src="{{$d->image_url}}" alt="" style="width: 70px">
            </td>
            <td>{{$d->name}}</td>
            <td>{{$d->phone}}</td>
            <td>
                <a href="{{route('category.edit',$d->id)}}" class="btn btn-primary">Edit</a>

                <form method="POST" action="{{route('category.destroy',$d->id)}}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
