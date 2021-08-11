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
				<div class="card-header">{{ __('FİRMA SEVKİYAT FİŞİ') }}</div>
				<table border="1">
					<tr>
						<div class="col-md-6">
								<th colspan="2">Firma = {{$ship->order->firma->name ?? ''}}-{{$ship->order->firma->city->name ?? ''}} </th>
								<th>Tarih = {{date('d-m-Y', strtotime($ship->created_at))}}</th>
							</div>
					</tr>
					<tr>
								<th>Nakliye Firması = {{$ship->order->firma->parent->name ?? ''}} </th>
								<th>Koli Adedi = {{$ship->order->koliadet ?? ''}} </th>
								<th>İrsaliye No ={{$ship->irsaliyeno}} </th>
						
					</tr>
				</table>
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>Sipariş No</th>
								<th>KOD</th>
								<th>ÜRÜN</th>
								<th>ADET</th>
								<th>B.Fiyat</th>
								<th>Tutar</th>
								<th>Para Birimi</th>
							</div>
						</tr>
					</thead>
					<tbody> 
						@php $totad=0;$totbirim=0;$totbak=0; @endphp
						@if($ship->shipping)
						@foreach($ship->shipping as $list)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td><a target="_blank" href="{{route('sevkreport',$list->order_id)}}"> {{ $list->order->no }}</td>
							<td>{{ $list->urun->no ?? ''}}</td>
							<td>{{ $list->urun->name ?? ''}}</td>
							<td>{{ $totadet= $list->where('urun_id',$list->urun_id)->where('ship_id',$ship->id)->where('order_id',$list->order_id)->count('id') }}</td>
							<td>{{ $totbirimfiyat= $list->order->orderdetails->where('urun_id',$list->urun_id)->where('order_id',$list->order_id)->pluck('fiyat')->first()}}</td> 
							<td align="right">{{  number_format( $totbirimfiyat  * $totadet ,2,',','.') }}</td>
							<td>{{ $list->order->firma->kur->name ?? ''}}</td>
						</tr>
						@php  $totbakiye= $totbirimfiyat  * $totadet;
						 $totad += $totadet; $totbirim += $totbirimfiyat; $totbak += $totbakiye; 
						@endphp

						@endforeach
						@endif
						<tr>
							<td colspan="4">TOPLAM</td>
							<td>{{$totad}}</td>
							<td><!-- {{number_format($totbirim,2)}} --></td>
							<td align="right">{{number_format($totbak,2,',','.')}}</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection