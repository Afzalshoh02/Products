@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать продукт</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название продукта <span class="text-danger">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control mt-1"
                    value="{{ old('name') }}"
                    required
                    minlength="10"
                    placeholder="Введите название продукта (минимум 10 символов)">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <br>

            <div class="form-group">
                <label for="article">ARTICLE <span class="text-danger">*</span></label>
                <input type="text" id="article" name="article" class="form-control mt-1" value="{{ old('article') }}"
                       required>
                @error('article')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
        </form>
    </div>
@endsection
