@extends('layouts.app')

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
				<div class="card-header">{{ __('FİRMA İRSALİYESİ') }}</div>
				<table border="1">
					<tr>
						<div class="col-md-6">
								<tr>
								<th colspan="2">Firma = {{$shipa->order->firma->name ?? ''}} - {{$shipa->order->firma->city->name ?? ''}} </th>
								<th>Tarih = {{date('d-m-Y', strtotime($shipa->updated_at))}}</th>
								</tr>
								<tr>
								<th>Nakliye Firması = {{$shipa->order->firma->parent->name ?? ''}} </th>
								<th>İrsaliye No = {{$shipa->irsaliyeno}} </th>
								<th>Koli Adedi = {{$shipa->order->koliadet}} </th>
								</tr>
							</div>
					</tr>
				</table>
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>ÜRÜN</th>
								<th>ADET</th>
								<th>FİYAT</th>
								<th>TUTAR</th>	
							</div>
						</tr>
					</thead>
					<tbody> 
						@php $totad=0; $toplam=0; $toplamtot=0; @endphp
						@foreach($ship as $list)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $list->tmad ?? ''}}</td>
							<td>{{ $totadet = $list->tmadcount ?? ''}}</td>
							<td>
								@if($list->urunorder_id != $list->order_id)
									{{ $tot= $order->where('order_id',$list->urunorder_id)->where('urun_id',$list->urun_id)->pluck('fiyat')->first() ?? ''}}
								@else
								{{ $tot= $shipa->order->orderdetails->where('urun_id',$list->urun_id)->pluck('fiyat')->first() ?? ''}} 
								@endif
							</td>
							@php   $tutar= $totadet * (float)$tot; @endphp
                            <td align="right"> {{ number_format($tutar,2,',','.') }}</td>
						</tr>
						@php 
						$totad += $totadet; 
						$toplam += is_numeric($tot); 
						$toplamtot += $tutar; 
						@endphp
						@endforeach
						<tr>
							<td colspan="2">TOPLAM</td>
							<td>{{$totad}}</td>
							<td></td>
                            <td align="right"> {{ number_format($toplamtot,2,',','.') }}</td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>

@endsection