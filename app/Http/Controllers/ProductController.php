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
        $products = $this->preparaDati($products);
        
        return view('prodotti.index', compact('products', 'vista'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|max:5',
        ]);

        $tableProduct = Product::create($request->all());

        return redirect('prodotti');
    }

    public function edit(Product $product)
    {  
        $products = Product::query();
        $vista = true;
        $products = $this->preparaDati($products);

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

    //Filtro ordine con sessione 
    public function filterOrder(Request $request)
    {
        $datiOrder = array (
            'prezzo' => $request->input('prezzo'),    
            'nome' => $request->input('nome'),            
        );
        session()->put('filterOrder', $datiOrder);

        return redirect('prodotti');
    }

    //Filtro ricerca con sessione 
    public function filterSearch(Request $request)
    {
        $datiSearch = array (
            'nomeProdotto' => $request->input('nomeProdotto'),
            'prezzoProdotto' => $request->input('prezzoProdotto'),
        );

        session()->put('filterSearch', $datiSearch);

        return redirect('prodotti');
    }

    // Filtro cancella sessione ricerca
    public function filterClear()
    {
        session()->forget('filterSearch');

        return redirect('prodotti');
    }  

    // Funzioni create
    private function preparaDati($products)
    {
        $filtriOrder = session('filterOrder');
        $filterSearch = session('filterSearch');

        // Filtri Search
        if(isset($filterSearch['nomeProdotto'])) {
            $products = $products->where('name', 'LIKE', "%{$filterSearch['nomeProdotto']}%");
        }

        if(isset($filterSearch['prezzoProdotto'])) {
            $products = $products->where('price', 'LIKE', "%{$filterSearch['prezzoProdotto']}%");
        }

        // Filtri Order
        if ($filtriOrder['nome'] == 'comAsc') {
            $products = $products->orderBy('name', 'asc');
        } elseif ($filtriOrder['nome'] == 'comDsc') {
            $products = $products->orderBy('name', 'desc');
        } elseif ($filtriOrder['prezzo'] == 'comAsc') {
            $products = $products->orderBy('price', 'asc');
        } elseif ($filtriOrder['prezzo'] == 'comDsc') {
            $products = $products->orderBy('price', 'desc');
        } else {
            $products = $products->orderBy('created_at', 'asc');
        }
        
        return $products->paginate(4);
    }

}
