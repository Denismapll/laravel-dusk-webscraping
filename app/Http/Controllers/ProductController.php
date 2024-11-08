<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(Request $request)
{
    $query = Product::query();

    // Filtro de Estoque
    if ($request->filled('estoque')) {
        // Verifica se o parâmetro "estoque" foi enviado e não está vazio
        $query->where('estoque', $request->estoque);
    }

    // Filtro de Preço Mínimo
    if ($request->filled('preco_min')) {
        // Verifica se o preço mínimo foi enviado e não está vazio
        $query->where('price', '>=', $request->preco_min);
    }

    // Filtro de Preço Máximo
    if ($request->filled('preco_max')) {
        // Verifica se o preço máximo foi enviado e não está vazio
        $query->where('price', '<=', $request->preco_max);
    }

        // Ordenação por preço
        if ($request->has('sort') && $request->sort === 'price') {
            $order = $request->order === 'desc' ? 'desc' : 'asc';
            $query->orderBy('price', $order);
        } 

    // Executa a consulta com paginação
    $products = $query->paginate(10); // ou o número de itens por página que você preferir

    // Retornar a view com os produtos
    return view('products.index', compact('products'));
}

}
