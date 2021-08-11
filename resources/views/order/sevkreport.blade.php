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
				<div class="card-header">{{ __('SİPARİŞ FİŞi') }}</div>
				<table border="1">
					<tr>
						<div class="col-md-6">
								<th>FİRMA = {{$order->firma->name ?? ''}} - {{$order->firma->city->name ?? ''}} </th>
								<th>İSKONTA = {{$order->iskonta}} </th>
								<th>VADE = {{$order->vade}} </th>
								<th>NAK.FİRMA = {{$order->firma->parent->name ?? ''}} </th>
								<th>KOLİ AD. = {{$order->koliadet}} </th>
							</div>
					</tr>
					<tr>
						<td>
							SİPARİŞİN FİŞLERİ =
						</td>
						<td colspan="4">
						@foreach($order->shipping as $list)
							<a target="_blank" href="{{route('shipfis',$list->ship_id)}}">{{date('d-m-Y',strtotime($list->created_at))}}</a>
							---
						@endforeach
						</td>
					</tr>
				</table>
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>KOD</th>
								<th>ÜRÜN</th>
								<th>SİPARİŞ AD.</th>
								<th>SEVK AD.</th>
								<th>KALAN AD.</th>
								<th>LİSTE FİYATI</th>
								<th>BİRİM FİYATI</th>
								<th>KALAN TUTAR</th>
								<th>D.CİNS</th>
								<!-- <th>BAKİYE</th> -->
							</div>
						</tr>
					</thead>
					<tbody> @php $tutar=0; $tot=0; @endphp
						@foreach($order->orderdetails as $list)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $list->urun->no ?? ''}}</td>
							<td>{{ $list->urun->name ?? ''}}</td>
							<td>{{ $list->miktar ?? ''}}</td>
							<td>{{ $list->miktar-$list->kalan ?? ''}}</td>
							<td>{{ $list->kalan ?? ''}}</td>
							<td>{{ number_format($list->listefiyat ?? '',2)}}</td>
							<td>{{ $fiyat= number_format($list->fiyat ?? '',2)}}</td>
							<td align="right">{{ $tutar= number_format((($list->kalan ?? '') * $fiyat),2) ?? ''}}</td>
							<td> {{$list->kur->name ?? ''}}</td>
							<!-- <td>{{ number_format($list->bakiye ?? '',3)}} TL</td> -->
						</tr> @php $tot += (float)$tutar; @endphp
						@endforeach
						<tr>
							<td colspan="3">Toplam</td>
							<td>{{$order->orderdetails->sum('miktar') ?? ''}} </td>
							<td>{{$order->orderdetails->sum('miktar') - $order->orderdetails->sum('kalan') ?? ''}} </td>
							<td>{{$order->orderdetails->sum('kalan') ?? ''}} </td>
							<td></td>
							<td></td>
							<td align="right">{{number_format($tot,3)}} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
@section('css')
<style type="text/css">
        tr:hover td {background:#FF7F50}
</style>
@endsection
