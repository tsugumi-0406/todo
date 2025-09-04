@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="todo-alert">
    @if(session('message'))
    {{ session('message') }}
    @endif
    @error('name')
    <div class="todo__alert--danger" >
        {{ $errors->first('name') }}
    </div>
    @enderror
</div>

<div class="main-section">
    <div class="create">
        <form action="/categories" class="create-form" method="post">
            @csrf
            <input type="text" class="create-form__text" name="name" value="{{ old('name') }}">
            <div create-form__content >
                <button class="create-form__button" type="submit">作成</button>
            </div>
        </form>
    </div>

    <div class="category-list">
        <table class="category-list__table">
            <tr class="category-list__table-top">
                <th class="category-list__table-title" colspan="2">category</th>
            </tr>
            @foreach($categories as $category)
            <tr class="category-list__table-row">
                <td class="category-list__table-inner">
                    <form class="category-list-form" action="/categories/update" method="post" >
                        @method('PATCH')
                        @csrf
                        <input type="text"  class="category-list__table-text" value="{{ $category['name'] }}" name="name">
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                        <button class="category-list__button-update">更新</button>
                    </form>
                </td>
                <td class="category-list__button-sell">
                    <form action="/categories/delete" method="post">
                        @method('DELETE')
                        @csrf
                         <input type="hidden" name="id" value="{{ $category['id'] }}">
                        <button class="category-list__button-delete">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>



@endsection