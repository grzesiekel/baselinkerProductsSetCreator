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
            @foreach($sets as $set)
            <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
               <div class="d-flex flex-row"><img class="rounded" src="{{asset('storage/img/' . $set->image)}}" width="40">
                  <div class="ml-2"><span class="font-weight-bold d-block">{{$set->sku}}</span><span class="spec">{{$set->name}}</span></div>
               </div>
               <!-- <div class="d-flex flex-row align-items-center"><span class="d-block">2</span></div> -->
               <div class="d-flex flex-row align-items-center">
                  <form class="d-block p-2" action="{{route('admin.sets.destroy',$set)}}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-outline-dark">usuń</button>
                  </form>
                  <a class="btn btn-primary" href="{{route('admin.sets.show',$set)}}" role="button">dodaj produkty</a>
               </div>
            </div>
            @endforeach
         </div>
      </div>

   </div>

</div>

@endsection