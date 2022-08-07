@foreach($products as $product)
<div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
    <div class="d-flex flex-row"><img class="rounded" src="{{asset('storage/img/' . $product->image)}}" width="40">
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