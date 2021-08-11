@extends('layouts.app')
@php $expand = 'false'; @endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Ürün Listesi') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{route('surun')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4"> 
                        <select name='list' class="form-control" onchange="location = this.value;">
                            <option value="">Ürün Türü Seç..</option>
                            @isset($urunturu)
                            @foreach ($urunturu as $list)
                                <option name="list" id="list" value="{{route('listurun',$list->id)}}">{{$list->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="jqxTree" style="overflow-x: scroll;">
                     <ul>
                        @foreach ($kategori as $list)
                        <li item-selected='false' item-expanded='{{$expand}}'>{{$list->name}}
                            <ul>
                                @if($list->urunaltkategori)
                                @foreach ($list->urunaltkategori as $alt)
                                <li id="{{$alt->id}}" name="urunaltkategori_id" item-expanded='{{$expand}}'>{{$alt->name ?? ''}}
                                   <ul>
                                    @if($alt->urun)
                                    @foreach ($alt->urun->groupBy('models.name') as $model=>$urun)
                                    <li name="model_id" item-expanded='{{$expand}}'>{{$model}} 
                                        <ul>
                                            @foreach ($urun as $product)
                                            <li name="urun_id" item-expanded='{{$expand}}'>
                                                {{$product->no}} {{$product->name}} 
                                                @isset($product->price->price) 
                                                Liste F.= {{$product->price->price }}TL @isset($product->store->miktar)||Stok={{$product->storedetail->count('urun_id') }} ADET @endisset
                                                @endisset 
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('css')
<link href="{{ asset('js/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxtree.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $('#jqxTree').jqxTree({
         width: '100%',
         theme: 'energyblue'
     });
        $('#jqxTree').css('visibility', 'visible');

        $('#jqxTree').on('initialized', function (event) {
            $('#jqxTree').jqxTree('expandAll');
        });
    });
</script>
@endsection