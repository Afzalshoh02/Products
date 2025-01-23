@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Список продуктов</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Добавить новый продукт</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Image</th>
                <th>Название продукта</th>
                <th>Артикул</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="https://placehold.co/100x50.png?text={{ $product->name }}" class="card-img-top" alt="Product Image"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->article }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Вы уверены, что хотите удалить этот продукт?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
