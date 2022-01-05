@extends('backend.layouts.master')
@section('title','Favorite list')
@section('content')


    <body>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Favorite List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Quantity</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book['id'] }}</td>
                                <td>{{ $book['title'] }}</td>
                                <td>{{ $book['content'] }}</td>
                                <td>{{ $book['quantity'] }}</td>
                                <td><a href="{{ route('deleteFavorite',$book['id'])}}">Delete</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    @endsection

    </body>













{{--<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>ID</th>--}}
{{--        <th>Title</th>--}}
{{--        <th>Content</th>--}}


{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--    @foreach($bookmark as $bookmark1)--}}
{{--        <tr>--}}
{{--            <td>{{$bookmark1['id']}}</td>--}}
{{--            <td>{{$bookmark1['title']}}</td>--}}
{{--            <td>{{$bookmark1['content']}}</td>--}}
{{--            @endforeach--}}

{{--        </tr>--}}

{{--    </tbody>--}}
{{--</table>--}}

