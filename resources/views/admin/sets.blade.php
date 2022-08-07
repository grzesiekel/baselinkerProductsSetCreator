@extends('layouts.admin')

@section('content')
<div class="row w-100 m-auto border border-primary justify-content-around">
   <div class="col-sm-12 col-md-12 col-lg-5 p-5 ">
      <div class="text-center">
         <h1 class="h4 text-gray-900 mb-4">Dodaj zestaw!</h1>
      </div>
      <x-admin.add-product-form action="{{route('admin.sets')}}" />

   </div>
   <div class="col-sm-12 col-md-12 col-lg-5 p-5">
      <div class="text-center">
         <h1 class="h4 text-gray-900 mb-4">Dodaj z pliku CSV</h1>
      </div>
      <form class="user" action="{{route('admin.sets.csv')}}" method="POST" enctype="multipart/form-data">
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
               <h1>Zestawy</h1>
            </div>
            {{$sets->links()}}
            <x-admin.products-list :products="$sets" />
         </div>
      </div>

   </div>

</div>

@endsection