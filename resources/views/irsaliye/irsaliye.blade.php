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
								<th>Firma = {{$shipa->order->firma->name.'-'.$shipa->order->firma->city->name ?? ''}} </th>
								<th>Nakliye Firması = {{$shipa->order->firma->parent->name ?? ''}} </th>
								<th>Koli Adedi = {{$shipa->order->koliadet}} </th>
							</div>
					</tr>
				</table>
				@if($shipa->order->firma->faturatipi_id == 1)
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>ÜRÜN</th>
								<th>ADET</th>
							</div>
						</tr>
					</thead>
					<tbody> 
						@php $totad=0; @endphp
						@foreach($ship as $list)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $list->tmad ?? ''}}</td>
							<td>{{ $totadet = $list->tmadcount }}</td>
						</tr>
						@php $totad += $totadet; 
						@endphp
						@endforeach
						<tr>
							<td colspan="2">TOPLAM</td>
							<td>{{$totad}}</td>
						</tr>
					</tbody>
				</table>
				@elseif ($shipa->order->firma->faturatipi_id == 2)
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>ÜRÜN</th>
								<th>ADET</th>
							</div>
						</tr>
					</thead>
					<tbody> 
						@php $totad=0; @endphp
						@foreach($ship as $list)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $list->ticariad ?? ''}}</td>
							<td>{{ $totadet = $list->ticariadcount }}</td>
						</tr>
						@php $totad += $totadet; 
						@endphp
						@endforeach
						<tr>
							<td colspan="2">TOPLAM</td>
							<td>{{$totad}}</td>
						</tr>
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection