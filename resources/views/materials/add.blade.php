@extends('app', ['title' => $title, 'types' => $types, 'categories' => $categories])

@section('user-javascript-url')
{{ URL::asset('/public/js/user/material_add.js') }}
@endsection

@section('content')
    <h1 class="my-md-5 my-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectType">
                        <option>Выберите тип</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelectType">Тип</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectCategory">
                        <option>Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelectCategory">Категория</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите название" id="floatingName">
                    <label for="floatingName">Название</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor">
                    <label for="floatingAuthor">Авторы</label>
                </div>
                <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                      style="height: 100px"></textarea>
                    <label for="floatingDescription">Описание</label>
                </div>
                <button id="material_add_button" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
@endsection