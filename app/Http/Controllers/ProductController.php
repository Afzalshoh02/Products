<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Jobs\SendProductCreatedNotification;
use App\Models\Product;
use App\Services\ProductPermissionService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Отображение формы создания продукта.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Сохранение нового продукта.
     */
    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        SendProductCreatedNotification::dispatch($product);

        return redirect()->route('products.index')->with('success', 'Продукт успешно создан!');

    }

    /**
     * Отображение формы редактирования продукта.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Обновление продукта.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $role = config('products.role');

        if ($role !== 'admin' && isset($request->article)) {
            return redirect()->route('products.index')->with('error', 'Вы не можете редактировать артикул!!!');
        }

        $validatedData = $request->validated();

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Продукт успешно обновлен!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Продукт удален успешно.');
    }

}
