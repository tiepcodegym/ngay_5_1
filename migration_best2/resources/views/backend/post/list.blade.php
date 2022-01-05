
@extends('backend.layouts.master')
@section('title','Post list')
@section('content')


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        @toastr_css
</head>

<body>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Post List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>User</th>
                        <th colspan="3" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->content}}</td>
                            <td>
                                @if(count($post->categories)>0)
                                    @foreach($post->categories as $category)
                                        <p>{{$category->name}}</p>
                                    @endforeach
                                @else
                                    <p>Chưa phân loại</p>
                                @endif
                            </td>
                            <td>{{ $post->user->name}}</td>
                            <td><button type="button" class="btn btn-outline-success"><a href="{{route('posts.edit',$post->id)}}"><i class="far fa-edit"></i></a></button></td>
                            <td><button type="button" class="btn btn-outline-success"><a href="{{route('posts.destroy',$post->id)}}"><i class="far fa-trash-alt"></i></a></button></td>
                            <td><button type="button" class="btn btn-outline-success"><a href="{{route('posts.addToFavorite',$post->id)}}"><i class="far fa-heart"></i></a></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$posts->links()}}
            </div>
        </div>
    </div>

</div>

@endsection

</body>
@jquery
@toastr_js
@toastr_render
</html>
















{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Post</title>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">--}}
{{--    @toastr_css--}}
{{--</head>--}}
{{--<body>--}}
{{--<a href="{{route("posts.create")}}">Them moi</a>--}}
{{--<a href="{{route("logout")}}">Dang xuat</a>--}}
{{--<table border="1px">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>ID</th>--}}
{{--        <th>Title</th>--}}
{{--        <th>Content</th>--}}
{{--        <th>Category</th>--}}
{{--        <th>User</th>--}}
{{--        <th colspan="2">Action</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($posts as $post)--}}
{{--    <tr>--}}
{{--        <td>{{$post->id}}</td>--}}
{{--        <td>{{$post->title}}</td>--}}
{{--        <td>{{$post->content}}</td>--}}
{{--        <td>--}}
{{--            @if(count($post->categories)>0)--}}
{{--            @foreach($post->categories as $category)--}}
{{--                <p>{{$category->name}}</p>--}}
{{--            @endforeach--}}
{{--            @else--}}
{{--            <p>Chua phan loai</p>--}}
{{--            @endif--}}
{{--        </td>--}}
{{--        <td>{{ $post->user->name}}</td>--}}
{{--        <td><a href="{{route('posts.edit',$post->id)}}">Update</a></td>--}}
{{--        <td><a href="{{route('posts.destroy',$post->id)}}">Delete</a></td>--}}
{{--    </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--</body>--}}
{{--@jquery--}}
{{--@toastr_js--}}
{{--@toastr_render--}}
{{--</html>--}}
