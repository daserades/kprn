@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header" align="center">
                    <a href="{{--route('shipping.edit',$order->id)--}}" style="color:black" title="YAZDIR" id="print"><i class="fas fa-print fa-2x"></i></a>
                    {{ __('Müşteri Bilgileri') }} 
                    <a href="{{route('sevkbitir', $ship->id ?? '')}}" id="print" style="color:black" title="SEVKİYATI BİTİR"><i class="fas fa-shipping-fast fa-2x"></i></a>

                    <select name='orderstatuses_id' id="orderstatuses_id" class="form-control  @error('orderstatuses_id') is-invalid @enderror">
                        <option value="{{$order->orderstatuses_id}}">@isset($order->orderstatus->name){{$order->orderstatus->name}}@endisset</option>
                        @foreach($orderstatus as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                    </select>
                    @error('orderstatuses_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <table  class="table-sm">
                    <tr>
                        <td>
                            Sipariş No   : {{$order->no  ?? ''}}
                        </td>
                        <td>Firma    :{{ $order->firma->name ?? ''}}
                        </td>
                        <td>Tarih     :{{ $order->created_at }}
                        </td>
                        <td>Sevk Tarih     :{{ date('d-m-Y',strtotime($order->sevktrh)) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   : {{ $order->aciklama }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            SİPARİŞİN FİŞLERİ =
                        </td>
                        <td colspan="4">
                        @foreach($order->ship as $list)
                            <a target="_blank" href="{{route('shipfis',$list->id)}}">{{date('d-m-Y',strtotime($list->created_at))}}</a>
                            ---
                        @endforeach
                        </td>
                    </tr>
                </table> 

                @if (count($oldorder)>0)
                <div class="card-header">{{ __('Geçmişten Kalan Sipariş  Bilgileri') }}</div>
                <table class="table-sm table-hover" style="border-color: orange" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Kod</td>
                                <td>Ürün</td>
                                <td>Kalan Miktar</td>
                                <td>Okutulan M.</td>
                                <!-- <td>Barkod Okuma</td> -->
                            </div>
                        </tr>
                    </thead>
                    <tbody>@php $koliici=0;$kalan=0;$kolisum=0;$oldtotkoli=0; $okunan=0; @endphp
                        @foreach($oldorder->sortBy('no') as $list)
                <form method="POST" action="{{route('oldorder')}}">
                    @csrf
                        <tr @if($list->kalan <= 0) style="background-color: green" @endif >
                        <input id="mevcutsiparis_id" name="mevcutsiparis_id" type="hidden" class="form-control" value="{{ $order->id }}">
                            <input type="hidden" name="order_id" value="{{$list->order_id}}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->no ?? ''}}</td>
                            <td>{{ '('.date('d-m-Y',strtotime($list->siptrh)).')'.$list->name  }}</td>
                            <td>{{ $kalan=$list->kalan }}</td>
                            <td>
                                @isset($ship->id)
                                {{  $ship->shipping->where('urun_id',$list->urun_id)->where('order_id',$list->orderid)->count('id')}}
                                @endisset
                            </td>
                            <!-- <td>{{$list->order_id }} </td> -->
                            <!-- <td><input type="number" name="barcode" value="{{ old('barcode') }}" autocomplete="barcode"  @if (Session::has('oldorderfocus'.$list->urun_id)) autofocus @endif placeholder="QR Kodu Okutunuz..."></td> -->
                        </tr> @php $koliici=$list->koliiciadet ?? '';  $kolisum =$kalan/$koliici;  $oldtotkoli += $kolisum; @endphp
                </form>  @php  if($ship) { $okunan += $ship->shipping->where('urun_id',$list->urun_id)->where('order_id',$list->orderid)->count('id'); } @endphp
                        @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>{{ $oldorder->sum('kalan') }} </td>
                                <td>@isset($okunan) {{$okunan}} @endisset </td>
                            </tr>
                    </tbody>
                </table>
                @endif
              <!--   @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif -->
                <div id="success" class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong><label id="message1"></label></strong>
                </div>
                <div id="error" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong><label id="message2"></label></strong>
                </div>
                <!-- <form method="POST" action="{{route('shipping.store')}}">
                    @csrf -->
                    <div class="card-header" id="print">{{ __('QR Kodu Okutma') }}</div> 
                    <div class="row align-items-center" id="print">
                        <input id="order_id" name="order_id" type="hidden" class="form-control" value="{{ $order->id }}">
                        <input id="ship_id" name="ship_id" type="hidden" class="form-control" value="{{-- $ship->id ?? ''--}}">
                        <label for="barcode" class="col-md-2 col-form-label text-md-center">{{ __('QR Kod - Ürün Okutma') }}</label>

                        <div class="col-md-10">
                            <input id="barcode" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"   @if (Session::has('autofocus')) autofocus @endif autofocus autocomplete="barcode" placeholder="QR Kodu - Ürünü Buraya Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                <!-- </form>  -->
                <div class="card-header">{{ __('Sevkiyat Bilgileri') }}</div>

                <table class="table-sm table-striped table-hover" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Kod</td>
                                <td>Ürün</td>
                                <td>Miktar</td>
                                <td>K.Miktar</td>
                                <td>Okutulan M.</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>@php $koliici=0;$kalan=0;$kolisum=0;$totkoli=0; @endphp
                        @isset($order->orderdetails)
                        @foreach($order->orderdetails->sortBy('urun.no') as $list)
                        <tr @if($list->miktar==$order->shipping->where('urun_id',$list->urun_id)->count('id')) style="background-color: green" 
                            @elseif($list->miktar<$order->shipping->where('urun_id',$list->urun_id)->count('id')) style="background-color: red"  @endif >
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->urun->no  ?? ''}}</td>
                            <td>{{ $list->urun->name ?? ''}}</td>
                            <td>{{ $list->miktar ?? ''}}</td>
                            <td>{{ $kalan=$list->kalan ?? ''}}</td>
                            <td>
                                {{ $order->shipping->where('urun_id',$list->urun_id)->sortBy('urun_id')->count('urun_id') }}
                                <!-- @isset($ship->id)
                                {{ $ship->shipping->where('urun_id',$list->urun_id)->where('ship_id',$ship->id)->where('order_id',$list->order_id)->count('id')}}
                                @endisset -->
                            </td>
                                    
                        </tr> @php $koliici=$list->urun->koliiciadet ?? '1';  $kolisum =$kalan/$koliici;  $totkoli += $kolisum; @endphp
                        @endforeach 
                        @endisset
                        <tr>
                            <td colspan="3">Toplam</td>
                            <td>{{$order->orderdetails->sum('miktar')}}</td>
                            <td>{{$order->orderdetails->sum('kalan')}}</td>
                            <td>
                                @isset($ship->id)
                                {{ $order->shipping->where('order_id',$order->id)->where('order_id',$list->order_id)->count('id')}}
                                @endisset
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-header" id="print">
                    <input type="number" id="koliadet" name="koliadet" value="" placeholder="Koli Adeti Giriniz"> Koli
                    <br>
                     Tahmini Koli Adeti---> {{ number_format($oldtotkoli ?? 0 + $totkoli ?? 0,2) ?? ''}}
                </div>
                <div>
                <form method="POST" action="{{route('destroyqr')}}">
                    @csrf
                    <div class="row align-items-center" id="print">
                        <input id="order_id" name="order_id" type="hidden" class="form-control" value="{{ $order->id }}">
                        <label for="barcode" class="col-md-3 col-form-label text-md-center">{{ __('Silinecek QR Kod') }}</label>
                        <div class="col-md-9">
                            <input id="barcodee" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" @if (Session::has('destroyqrfocus')) autofocus @endif  autocomplete="barcode"  placeholder="Silinecek QR Kodu Buraya Okutunuz..." >
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

@endsection
@section('css')
<style type="text/css">
   @media print {
      #print,#orderstatuses_id {
        display :  none;
    }

}
</style>
@endsection
@section('js')
<script type="text/javascript">
    $("#success,#error").hide();
    $("#print").click(function(){

        window.print();
       /* setTimeout( function() {
           history.go(-1);
       }, 100);
       */
    });
    $("#orderstatuses_id").change(function(){
        $(this).toggle('highlight');
        val = $(this).val();
        id = $("#order_id").val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
        sayfa = '{{ route('orderstatus') }}';
        $.post(sayfa, {val:val, id:id}, function(data) {
            $('select[name=orderstatuses_id').toggle( "highlight" );
            location.reload();
        });
    });

    $("input[name=koliadet").change(function(){
        $('input[name=koliadet').toggle( "highlight" );
        //val = $(this).val();
        id = $("#order_id").val();
        koliadet = $("#koliadet").val();
        ship_id = $("#ship_id").val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
        sayfa = '{{ route('koli') }}';
        $.post(sayfa, { id:id,koliadet:koliadet,ship_id:ship_id}, function(data) {
            $('input[name=koliadet').toggle( "highlight" );
        });
    });

     $("#barcode").change(function(){
        $('#barcode').toggle( "highlight" );
        barcode = $(this).val();
        order_id = $("#order_id").val();
        ship_id = $("#ship_id").val();
        // alert(barcode+' asd '+order_id+' qwe '+ship_id);
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
        sayfa = '{{ route('shipping.store') }}';
        $.post(sayfa, { barcode:barcode,order_id:order_id,ship_id:ship_id}, function(data) {

                // console.log(data.success);
            if (data.success == true)
                { 
                    $("#message2,#message1").empty();
                    $("#error").hide();$("#success").show();
                    $("#message1").append(data.message);
                }
            else if(data.success == false)
                { 
                    $("#message2,#message1").empty();
                    $("#error").show();$("#success").hide();
                    $("#message2").append(data.message);
                }
            else alert('Hatalı işlem');
                // console.log(data.message);
            $('#barcode').toggle( "highlight" );
            $('#barcode').val('');
            $('#barcode').focus();
        });
    });

  /*  $("input[name=oldbarcode").change(function(){
        $(this).toggle( "highlight" );
        order_id = $(this).attr('id');
        barcode= $(this).val();
        barcode= $().val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
         });
        sayfa = '{{ route('oldorder') }}';
        $.post(sayfa, {order_id:order_id,barcode:barcode}, function(data) {
            $('input[name=koliadet').toggle( "highlight" );
        });
    });
*/
</script>
@endsection