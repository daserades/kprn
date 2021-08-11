@foreach( $categories as $subCategory )
    {{ $subCategory->name }}<br>
    	@foreach( $subCategory->children as $category )
    		-->{{ $category->name }}<br>
    			 @foreach($category->urun->groupBy('models.name') as $models=>$urun)
    			 -----> {{$models}} <br>
    			 	@foreach($urun as $product)
    			 	 ------------>{{$product->name}}<br>
    			 	@endforeach
    			 @endforeach
		@endforeach
@endforeach