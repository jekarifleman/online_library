@extends('app', ['title' => $title, 'material' => $material, 'types' => $types, 'categories' => $categories])

@section('user-javascript-url')
{{ URL::asset('/public/js/user/material_edit.js') }}
@endsection

@section('content')
    <h1 class="my-md-5 my-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectType" data-type-id="{{ $material->type_id }}">
                        <option value="{{ $material->type_id }}">{{ $material->type_name }}</option>
                        @foreach($types as $type)
                            @if ($type->id != $material->type_id)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="floatingSelectType">Тип</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectCategory" data-category-id="{{ $material->category_id }}">
                        <option value="{{ $material->category_id }}">{{ $material->category_name }}</option>
                        @foreach($categories as $category)
                            @if ($category->id != $material->category_id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="floatingSelectCategory">Категория</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" value="{{ $material->name }}">
                    <label for="floatingName">Название</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor" value="{{ $material->authors }}">
                    <label for="floatingAuthor">Авторы</label>
                </div>
                <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                      style="height: 100px" data-default-value="{{ $material->description }}"></textarea>
                    <label for="floatingDescription">Описание</label>
                </div>
                <button id="material_update_button" class="btn btn-primary" data-material-id="{{ $material->id }}">Обновить</button>
            </div>
        </div>
    </div>
@endsection