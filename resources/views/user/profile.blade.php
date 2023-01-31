@extends('layout.master')


@section('content')
<div id="root"></div>
@endsection

@section('script')

<script>
    const TOTAL = @json($total);
</script>
<script src="{{asset('/js/ProfileRouter.js')}}"></script>
@endsection
