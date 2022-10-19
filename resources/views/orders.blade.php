@extends('layouts.app') 

@section('content')
<div class="container mt-3">
@foreach($categories as $category)
    
     <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th>zdjęcie</th>
                <th>Kategoria</th>
                <th>Sku</th>
                <th>Nazwa produktu</th>
                <th>Ilość</th>
                </tr>
            </thead>
            <tbody>
            @foreach($category as $product)
                <tr>
                <td><img width=60 class="img-fluid img-thumbnail" src="{{$product['image']}}" alt="image"></td>
                <td>{{$product['category']}}</td>
                <td>{{$product['sku']}}</td>
                <td>{{$product['name']}}</td>
                <td>{{$product['quantity']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
     </div>   
    
@endforeach
</div>
@endsection 