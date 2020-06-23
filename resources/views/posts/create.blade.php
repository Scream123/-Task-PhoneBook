@extends('layouts.app')

@section('title', 'Добавить запись')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto" id="div_form">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form method="POST" action="{{route('posts.store')}}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success mb-3">Добавить запись</button>
            <p class =" error-msg">Нельзя сохранить больше20-ти номеров</p>

            <div class="form-group">
                <label for="post-name">Имя</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="post-name">
            </div>
            <div class="form-group">
                <label for="post-surname">Фамилия</label>
                <input class="form-control" type="text" name="surname" value="{{old('surname')}}" id="post-surname">
            </div>
            <label for="post-phone">Телефон</label>
            <div class="entry input-group" id="dynamic_field">
                <input type="text" name="phone[]" value="{{old('phone')}}" class="form-control add-number" id="post-phone">
                <span class="input-group-btn">
                    <button class="btn btn-success btn-add" name="add" id="add" type="button">
                         <span class="glyphicon glyphicon-plus"></span>
                    </button>
                 </span>
            </div>
        </form>
        </div>
    </div>
@endsection