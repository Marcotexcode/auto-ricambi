<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query();
        $vista = false;

        $filtriOrder = session('filterOrder');

        if ($filtriOrder['nome'] == 'comAsc') {
            $products = $products->orderBy('name', 'asc')->paginate(3);
        } elseif ($filtriOrder['nome'] == 'comDsc') {
            $products = $products->orderBy('name', 'desc')->paginate(3);
        } elseif ($filtriOrder['prezzo'] == 'comAsc') {
            $products = $products->orderBy('price', 'asc')->paginate(3);
        } elseif ($filtriOrder['prezzo'] == 'comDsc') {
            $products = $products->orderBy('price', 'desc')->paginate(3);
        } else {
            $products = $products->orderBy('name', 'asc')->paginate(3);
        }
        
        return view('prodotti.index', compact('products', 'vista'));
    }

    public function store(Request $request)
    {
        $tableProduct = Product::create($request->all());

        return redirect('prodotti');
    }

    public function edit(Product $product)
    {  
        $products = Product::query();
        $vista = true;

        $filtriOrder = session('filterOrder');

        if ($filtriOrder['nome'] == 'comAsc') {
            $products = $products->orderBy('name', 'asc')->paginate(3);
        } elseif ($filtriOrder['nome'] == 'comDsc') {
            $products = $products->orderBy('name', 'desc')->paginate(3);
        } elseif ($filtriOrder['prezzo'] == 'comAsc') {
            $products = $products->orderBy('price', 'asc')->paginate(3);
        } elseif ($filtriOrder['prezzo'] == 'comDsc') {
            $products = $products->orderBy('price', 'desc')->paginate(3);
        } else {
            $products = $products->orderBy('name', 'asc')->paginate(3);
        }

        return view('prodotti.index', compact('product','products','vista'));
    }

    public function update(Request $request,Product $product)
    {
        $product->update($request->all());
        
        return redirect('prodotti');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('prodotti');
    }

    public function filterOrder(Request $request)
    {
        $datiOrder = array (
            'prezzo' => $request->input('prezzo'),    
            'nome' => $request->input('nome'),            
        );
        session()->put('filterOrder', $datiOrder);

        return redirect('prodotti');
    }

}
