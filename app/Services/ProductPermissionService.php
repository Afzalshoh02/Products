<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductPermissionService
{
    public static function canEditArticle()
    {
        return config('products.role') === 'admin';
    }

    public static function canEditProduct(Product $product)
    {
        // Логика проверки прав
        $role = config('products.role');
        // Для пользователя с ролью 'user' проверяем, что он не пытается редактировать артикул
        if ($role === 'user') {
            return !isset($product->article); // Пример проверки
        }
        return true;
    }
}
