@extends('app', ['title' => $title, 'tag' => $tag])

@section('user-javascript-url')
{{ URL::asset('/public/js/user/tag_edit.js') }}
@endsection

@section('content')
    <h1 class="my-md-5 my-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" value="{{ $tag->name }}">
                    <label for="floatingName">Название</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <button data-tag-id="{{ $tag->id }}" id="tag_edit_button" class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </div>

@endsection