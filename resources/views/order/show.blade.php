@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
				<div class="card-header">{{ __('Sipariş') }}</div>

				@if ($message = Session::get('success'))	
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
					<table class="table-striped"> 
					<tr>
						<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center">{{ __('Sipariş No:  ') }}{{ $order->no ?? ''}}</label>	
					</div>
					</td>
					<td colspan="2">
					<div class="card-body text-md-center"><img src="{{ Storage::url('logo.jpg') }}" alt="Smiley face" height="80" width="300"></div>
				</td>
				</tr><tr><td>
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Firma Adı:  ') }}{{ $order->firma->name }}</label>	
					</div></td><td>
					<div>
						<label for="firma_no" class="col-md-12 col-form-label text-md-left">{{ __('Sevk Tarihi:  ') }}{{ $order->sevktrh }}</label>	
					</div></td>
					<td><div>
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('İskonta:  ') }}{{ $order->iskonta ?? '' }}</label>	
					</div></td></tr>
					<tr><td>
					<div>
						<label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('vade:  ') }}{{ $order->vade }}</label>	
					</div></td>
					<td><div>
						<label for="tesis_id" class="col-md-12 col-form-label text-md-left">{{ __('Kur:  ') }}{{ $order->bazkur ?? ''}}</label>	
					</div></td><td>	
					<div>
						<label for="ordertur_id" class="col-md-12 col-form-label text-md-left">{{ __('Döviz Cinsi  :')   }} {{ $order->kur->name ?? ''}} </label>	
					</div></td></tr>
					<tr><td colspan="3">	
					<div>
						<label for="aciklama1" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama  :  ') }}{{ $order->aciklama }}</label>	
					</div></td></tr><tr><td colspan="3">	
					<div>
						<label for="sevkadres" class="col-md-12 col-form-label text-md-left">{{ __('Sevk Adresi  :  ') }}{{ $order->sevkadres }}</label>	
					</div></td></tr>					
					</table>
					<div class="card-header">{{ __('Sipariş Detayı') }}</div>

                <table class="table-striped" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>Kod</th>
                                <th>Ürün</th>
                                <th>Miktar</th>
                                <th>B.Fiyat</th>
                                <th>Tutar</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($order->orderdetails)
                        @foreach($order->orderdetails->sortBy('urun.no') as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->urun->no ?? ''}}</td>
                            <td>{{ $list->urun->name ?? ''}}</td>
                            <td align="right">{{ $list->miktar}} ad.</td>
                            <td align="right">{{ number_format($list->fiyat,3,',','.') }} <!-- {{$list->kur->name ?? ''}} --></td>
                            <td align="right">{{ number_format($list->tutar,3,',','.') }}</td>
                        </tr>
                        @endforeach @endisset
                        <tr>
                        	<th colspan="3">Toplam</th>
                        	<td align="right">{{$order->orderdetails->sum('miktar')}} ad.</td>
                        	<td ></td>
                        	<td align="right">{{number_format($order->orderdetails->sum('tutar'),3,',','.')}}</td>
                        </tr>
            </tbody></table>
			</div>
		</div>
	</div>
</div>
@endsection
