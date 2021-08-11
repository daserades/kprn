@extends('layouts.app')
@php $expand = 'false'; @endphp
@isset($link) @php $expand= $link; @endphp @endisset
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="card-header">{{ __('Ürün Fiyat Listesi') }}</div> 
<div class="row">
    <div class="col-md-4">{{$order->no ?? ''}} {{$order->firma->name ?? ''}}</div>
    <div class="col-md-4">
        <form action="{{route('sorderdetail')}}" method="get">
            <div class="input-group">
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Ara</button>
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-4"> 
                            @if ($list > 0 )  <input type="hidden" name="wsx" id="wsx" value="{{$list ?? ''}} ">  @endif
                        <select name='list' class="form-control" onchange="location = this.value;">
                            @isset($urunturu)
                            @foreach ($urunturu as $list)
                                <option name="list" id="list{{$list->id}}" value="{{route('listorder',[$list->id,$order->id])}}">{{$list->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
</div>
<div class="card-body">
    <div id="jqxTree" style="overflow-x: scroll;">
     <ul>
        @foreach ($kategori as $list)
        <li item-selected='false' item-expanded='@php echo $expand; @endphp'>{{$list->name}}
            <ul>
                @if($list->urunaltkategori)
                @foreach ($list->urunaltkategori as $alt)
                <li  name="urunaltkategori_id" item-expanded='@php echo $expand; @endphp'>{{$alt->name ?? ''}}
                   <ul>
                    @if($alt->urun)
                    @foreach ($alt->urun->groupBy('models.name') as $model=>$product)
                    <li  name="model_id" item-expanded='@php echo $expand; @endphp'> {{$model ?? ''}} 
                        <ul>
                            @if($product)
                            @foreach($product as $urun)
                            <li  name="urun_id" item-expanded='@php echo $expand; @endphp'>
                                {{$urun->no ?? ''}}  {{$urun->name ?? ''}}<br> 
                                @isset($urun->price->price) 
                                @if($order->kur_id == 1 || $order->kur_id==null)
                                Liste F.= <label id="{{$urun->id}}_listefiyat">{{$urun->price->price}} TL</label> ||
                                İskonta F.=<input type="number" step="0.001"  id="{{$urun->id}}" class="fiyat" name="{{$urun->id}}_fiyat" value="{{number_format($urun->price->price - (($urun->price->price)*($order->iskonta)/100),3) }}"> 
                                @elseif($order->kur_id == 2 || $order->kur_id == 3)
                                Liste F.= <label id="{{$urun->id}}_listefiyat">{{ number_format(($urun->price->price)/$order->bazkur,3) }} {{$order->kur->name}}</label> ||
                                İskonta F.=<input type="number" step="0.001"   id="{{$urun->id}}" class="fiyat" name="{{$urun->id}}_fiyat" value="{{ number_format(($urun->price->price - (($urun->price->price)*($order->iskonta)/100))/$order->bazkur,3) }}">
                                @endif
                                @endisset 
                                <td>{{$order->kur->name ?? ''}}
                                    <input type="hidden" name="{{$urun->id}}_kur" value="{{$order->kur_id}}">  
                                    <input type="hidden" name="{{$urun->id}}_order" value="{{$order->id}}">  
                                    <input type="hidden" name="{{$urun->id}}_bazkur" value="{{$order->bazkur}}">  
                                </td> 
                                <td align="right">
                                    <input type="number" id="{{$urun->id}}" name="{{$urun->id}}_adet" class="adet" placeholder="Adet" min="0" value="{{$order->orderdetails->where('urun_id',$urun->id)->first()->miktar ?? ''}}">
                                </td>
                                <td>
                                    S.U.Stok={{$urun->store->miktar ?? '0'}}
                                </td>
                                <td>
                                    F.Stok={{$urun->storedetail->count('urun_id')}}
                                </td>
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
            @endif
        </ul>
    </li>
    @endforeach
</ul>
</div>
</div>

@endsection
@section('css')
<link href="{{ asset('js/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
<style type="text/css">
    input[type=number]{
        width: 67px;
    } 
</style>
@endsection
@section('js')
<script src="{{ asset('js/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxtree.js') }}"></script>
<script src="{{ asset('js/jqwidgets/jqxbuttons.js') }}"></script>
<!--<script src="{{-- asset('js/jqwidgets/jqxcheckbox.js') --}}"></script>
<script src="{{-- asset('js/jqwidgets/jqxpanel.js') --}}"></script>
<script src="{{-- asset('js/jqwidgets/jqxmenu.js') --}}"></script>
-->
<script type="text/javascript">
    $(function() {

                       var wsx= $("#wsx").val();
                       var value = $("#list"+wsx).val();
     if (wsx > 0) 
        $("select[name='list']").val(value);


        $('#jqxTree').jqxTree({
         width: '100%',
         theme: 'energyblue'
     });
        $('#jqxTree').css('visibility', 'visible');

        /*$(".adet, .fiyat").keyup(function(e){
        //$(".adet, .fiyat").on("keyup change",function(e){
            if( e.which == 13 ){
                $(this).toggle( "highlight" );
                toggle=$(this).attr('class');
                urun_id = $(this).attr('id');       
                fiyat = $("input[name="+urun_id+"_fiyat]").val();
                kur_id = $("input[name="+urun_id+"_kur]").val();
                order_id = $("input[name="+urun_id+"_order]").val();
                bazkur = $("input[name="+urun_id+"_bazkur]").val();
                listefiyat = $("label[id="+urun_id+"_listefiyat]").text();
                deger = $("input[name="+urun_id+"_adet]").val();
                $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
                sayfa = '{{ route('orderdetail.store') }}';
                $.post(sayfa, {order_id:order_id,kur_id:kur_id,fiyat:fiyat,bazkur:bazkur,urun_id: urun_id, deger: deger,listefiyat:listefiyat }, function(data) {
                    $('input[name='+urun_id+'_'+toggle+']').toggle( "highlight" );
                });
            }
        });*/
        $(".adet, .fiyat").change(function(e){
        //$(".adet, .fiyat").on("keyup change",function(e){
                $(this).toggle( "highlight" );
                toggle=$(this).attr('class');
                urun_id = $(this).attr('id');       
                fiyat = $("input[name="+urun_id+"_fiyat]").val();
                kur_id = $("input[name="+urun_id+"_kur]").val();
                order_id = $("input[name="+urun_id+"_order]").val();
                bazkur = $("input[name="+urun_id+"_bazkur]").val();
                listefiyat = $("label[id="+urun_id+"_listefiyat]").text();
                deger = $("input[name="+urun_id+"_adet]").val();
                $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
                sayfa = '{{ route('orderdetail.store') }}';
                $.post(sayfa, {order_id:order_id,kur_id:kur_id,fiyat:fiyat,bazkur:bazkur,urun_id: urun_id, deger: deger,listefiyat:listefiyat }, function(data) {
                    $('input[name='+urun_id+'_'+toggle+']').toggle( "highlight" );
                });
            
        });
    });




</script>
@endsection