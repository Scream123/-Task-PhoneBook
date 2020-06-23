@extends('layouts.app')

@section('title', $post->name)
@section('content')
    <div class="card">
        <div class="card-body">
          <h3>{{$post->name}}</h3>
            <p>{{$post->surname}}</p>
            @foreach ($post->phones as $data)


          <p>{{$data->number}}</p>
            @endforeach
        </div>
    </div>
@endsection