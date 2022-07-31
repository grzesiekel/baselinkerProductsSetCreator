@extends('layouts.admin')

@section('content')
<div class="row w-50 m-auto border border-primary">
<div class="col p-5 ">
               <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Dodaj produkt!</h1>
               </div>
               <form class="user" action="{{route('admin.products')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @error('name')
                  <div class="invalid-feedback d-block">
                     {{$message}}
                  </div>
                  @enderror
                  <div class="form-group">
                     <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nazwa kolekcji">
                  </div>
                  @error('sku')
                  <div class="invalid-feedback d-block">
                     {{$message}}
                  </div>
                  @enderror
                  <div class="form-group">
                     <input type="text" class="form-control form-control-user" id="sku" name="sku" placeholder="Sku kolekcji">
                  </div>
                  @error('baseId')
                  <div class="invalid-feedback d-block">
                     {{$message}}
                  </div>
                  @enderror
                  <div class="form-group">
                     <input type="text" class="form-control form-control-user" id="baseId" name="baseId" placeholder="baselinker id">
                  </div>
                  @error('image')
                  <div class="invalid-feedback d-block">
                     {{$message}}
                  </div>
                  @enderror
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                     </div>
                     <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Wybierz zdjęcie</label>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-google btn-user btn-block">
                     <i class="fas fa-solid fa-plus"></i> Dodaj produkt
                  </button>
               </form>
            
            </div>
            <div class="col p-5">
            <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Dodaj z pliku CSV</h1>
               </div>
                  <form class="user" action="{{route('admin.products.csv')}}" method="POST" enctype="multipart/form-data">
                     @csrf

                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                           <input type="file" name="csv" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                           <label class="custom-file-label" for="inputGroupFile01">Wybierz plik</label>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-google btn-user btn-block">
                        <i class="fas fa-solid fa-plus"></i> Dodaj plik csv
                     </button>
                  </form>
               </div>
</div>
<div class="container mt-5 p-3 rounded cart ">
      <div class="row no-gutters">
         <div class="col-md-8">
            <div class="product-details mr-2">
               <div class="text-center">
                  <h1>Produkty</h1>
               </div>
               @foreach($products as $product)
               <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                  <div class="d-flex flex-row"><img class="rounded" src="{{$product->image}}" width="40">
                     <div class="ml-2"><span class="font-weight-bold d-block">{{$product->sku}}</span><span class="spec">{{$product->name}}</span></div>
                  </div>
                  <!-- <div class="d-flex flex-row align-items-center"><span class="d-block">2</span></div> -->
                  <div class="d-flex flex-row align-items-center">
                     <form class="d-block p-2" action="{{route('admin.products.destroy',$product)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-dark">usuń</button>
                     </form>
                     
                  </div>
               </div>
               @endforeach
            </div>
         </div>

      </div>
      {!! $products->links() !!}
   </div>

@endsection