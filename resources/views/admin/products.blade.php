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

@endsection