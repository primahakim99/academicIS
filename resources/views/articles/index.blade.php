@extends('student.layout')
@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" style="width:95%;margin: 0 auto;">
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
        </tr>
    @foreach ($articles as $article)
    <tr>
        <td>{{ $article->title }}</td>
        <td>{{ $article->content }}</td>
        <td><img width="150px"
        src="{{asset('storage/'.$article->featured_image)}}"></td>
    </tr>
    @endforeach
    </table>
@endsection
