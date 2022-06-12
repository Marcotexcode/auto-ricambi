<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('PRODOTTI') }}
  </h2>
  </x-slot>
  
  <section class=" py-1 bg-blueGray-50">

    @if ($errors->any())
      <div class="bg-rose-600 p-5 w-85">
        <ul>
          @foreach ($errors->all() as $error)
            <li> {{$error}} </li>
          @endforeach
        </ul>  
      </div>
    @endif

    <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
           <form action="{{ !$vista ? route('prodottiStore') : route('product.update', $product->id)}}" method="POST">
              @csrf
              @if (!$vista)
                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">Crea Prodotto</h6>
              @elseif($vista)
                @method('PUT')
                <a href="{{url('/prodotti')}}" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">return</a>
                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">Modifica prodotto</h6> 
              @endif
            <div class="flex flex-wrap">
              <div class="w-full lg:w-6/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">Nome</label>
                  <input value="{{!$vista ? old('name') : $product->name }}" type="text" name="name" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('name') is-invalid @enderror">
                </div>
              </div>
              <div class="w-full lg:w-6/12 px-4">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">Prezzo</label>
                  <input value="{{!$vista ? old('price') : $product->price }}" type="number" name="price" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('price') is-invalid @enderror">
                </div>
              </div>
            </div>
            <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="submit">Invia</button>
          </form> 
        </div>

        @if (!$vista)
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form action="{{url('filterSearch')}}">
              <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">Trova Prodotto</h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">Nome</label>
                    <input value="" type="text" name="nomeProdotto" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                  </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">Prezzo</label>
                    <input value="" type="number" name="prezzoProdotto" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                  </div>
                </div>
              </div>
              <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="submit">Invia</button>
            </form> 
            <form class="mt-4" action="{{url('filterClear')}}">
              <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="submit">Annulla</button>
            </form>
          </div>   
        @endif
        
        <div class="flex px-5 justify-center ">
          <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
              <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                 {{-- ****************** inizio filtro ordine ********************* --}}
                  <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    <form action="{{url('filterOrder')}}">
                      <select name='nome' class="bg-gray-600 appearance-none" onchange='this.form.submit()'>
                        <option>Nome</option>
                        <option value="comAsc">Ascendente</option>
                        <option value="comDsc">Discendente</option>
                        <noscript><input class="hidden" type="submit"></noscript>
                      </select>
                    </form>
                  </th>
                  <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    <form action="{{url('filterOrder')}}">
                      <select name='prezzo' class="bg-gray-600 appearance-none" onchange='this.form.submit()'>
                        <option>Prezzo €</option>
                        <option value="comAsc">Ascendente</option>
                        <option value="comDsc">Discendente</option>
                        <noscript><input class="hidden" type="submit"></noscript>
                      </select>
                    </form> 
                  </th>
                  {{-- ****************** fine filtro ordine ********************* --}}
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Azioni</th>
              </tr>
            </thead>
            <tbody class="block md:table-row-group">
              @foreach ($products as $product)
                <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                  <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold"></span>{{$product->name}}</td>
                  <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold"></span>{{$product->price}}</td>
                  <td class="p-2 flex md:border md:border-grey-500  ">
                    <button class="bg-blue-500 mx-3 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded"><a href="{{route('product.edit',$product->id)}}">Edit</a></button>
                    <form action="{{route('product.destroy', $product->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach  
            </tbody>
          </table>
        </div>
        <div class="flex p-5 justify-center">
          {{ $products->links() }} 
        </div>
      </div>
    </div>
  </section>

</x-app-layout>