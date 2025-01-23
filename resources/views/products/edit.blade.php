@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать продукт</h1>
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название продукта <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control mt-1" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="article">Артикул</label>
                <input type="text" id="article" name="article" class="form-control mt-1" value="{{ old('article', $product->article) }}" required>
                @error('article')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Обновить</button>
        </form>
    </div>
@endsection
