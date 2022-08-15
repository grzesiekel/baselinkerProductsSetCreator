@extends('layouts.admin')

@section('content')
<div class="container-fluid">
   <div class=" w-100 mx-auto "> <h1 class="text-center">SKU: {{$set->sku}}</h1></div>
   <div class="row">
   @forelse ($setProducts as $product)
      <div class="col-lg-2 col-md-2 col-sm-12 overflow-hidden">
      
         <div class="card" style="width: 12rem;">
            <img src="{{$product->image}}" class="card-img-top" alt="">
            <div class="card-body">
               <h5 class="card-title">{{$product->sku}}</h5>
               <p class="card-text">{{$product->name}}</p>
               <p class="card-text">ilość: {{$product->pivot->quantity}}</p>
               <form action="{{route('admin.sets.detachProduct',['set'=>$set,'product'=>$product])}}" method="post">
                  @method('delete')
                  @csrf
                  <button class="btn btn-secondary" type="submit">usuń z zestawu</button>
               </form>
            </div>
         </div>
       
      </div>
      @empty
      <p>Brak produktów w zestawie</p>
      @endforelse
      
   </div>
   <div class="row">
      <div class="mx-auto">
         <form action="{{route('admin.sets.show',$set)}}" method="get">

            <div class="input-group">
               <div class="form-outline">
                  <input type="search" name="productsName" id="form1" placeholder="wpisz nazwę produktu" class="form-control" />
                  <!-- <label class="form-label" for="form1">Search</label> -->
               </div>
               <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i>
               </button>
            </div>
         </form>
      </div>
   </div>
   <div class="row">
      <div class="container mt-5 p-2 rounded cart ">
         <div class="row no-gutters">
            <div class="col-md-10">
               <div class="product-details mr-2">

                  @foreach($products as $product)
                  <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                     <div class="d-flex flex-row"><img class="rounded" src="{{$product->image}}" width="40">
                        <div class="ml-2"><span class="font-weight-bold d-block">{{$product->sku}}</span><span class="spec">{{$product->name}}</span></div>
                     </div>
                     <!-- <div class="d-flex flex-row align-items-center"><span class="d-block">2</span></div> -->
                     <div class="d-flex flex-row align-items-center">
                        <form method="post" action="{{route('admin.sets.attachProduct',['set'=>$set,'product'=>$product])}}">
                           @csrf
                           @error('quantity')
                           <div class="invalid-feedback d-block">
                              {{$message}}
                           </div>
                           @enderror
                           <input type="number" step="0.1" name="quantity">
                           <button class="btn btn-primary" type="submit" role="button">dodaj do zestawu</button>
                        </form>

                     </div>
                  </div>
                  @endforeach
               </div>
            </div>

         </div>

      </div>
   </div>
</div>
@endsection