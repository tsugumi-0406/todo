@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="main-section">
    @if (session('message'))
    <div class="main-section__error">
        {{ session('message') }}
    </div>
    @endif


    @error('content')
    <div class="todo__alert--danger" >
        {{ $errors->first('content') }}
    </div>
    @enderror
</div>

<div class="main-section__text">
    <div class="main-form">
        <h2 class="form-title">新規作成</h2>
        <form action="/todos" class="create-form" method="post">
            @csrf
            <div class="create-form__item">
                <input type="text" class="create-text" name="content" value="{{ old('content') }}"/>
                <select type="text" class="category-text" name="category_id" >
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
            </select>
            </div>
            <button class="create-button" name="submit">作成</button>
        </form>
    </div>
    <div class="main-form">
        <h2 class="form-title">Todo検索</h2>
        <form action="/todos/search" class="search-form" method="get">
            @csrf
            <div class="search-form__item">
                <input type="text" class="create-text" name="content" name="keyword" value="{{ old('keyword') }}">
                <select class="category-text" name="category_id" >
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button class="search-button" name="submit">検索</button>
        </form>
    </div>

    <div class="todo-table">
        <table class="list" >
            <tr>
                <th class="table__title">
                    <div class="table__title-sell">
                        <div class="table__title-todo">Todo</div>
                        <div class="table__title-category">カテゴリ</div>
                    </div>
                </th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td class="list-sell">
                    <form class="update-form" method="post" action="/todos/update">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input class="update-form__item-input"
                            type="text" name="content"  value=" {{ $todo['content'] }}">
                             <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__item">
                            <p>{{ $todo['category']['name'] }}</p>
                        </div>
                        <div class="update-form__button">
                            <button class="button__update" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="button-sell">
                    <form class="delete-form" action="/todos/delete" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button class="button__delete" type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
