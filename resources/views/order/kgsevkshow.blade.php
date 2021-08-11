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
				<div class="card-header">{{ __('Sevk Raporu') }}</div>

				@if ($message = Session::get('success'))	
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
					<table class="table-striped"> 
					<tr>
						<td colspan="2">
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-left">{{ __('Firma:  ') }}{{ $kgsevk->firma->name ?? ''}}</label>	
					</div>
					</td>
					<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-right">{{ __('Tarih:  ') }}{{ $kgsevk->created_at ?? ''}}</label>	
					</div>
					</td>
					</tr>
					<tr>
					<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center">{{ __('Ürün:  ') }}{{ $kgsevk->urun->name ?? ''}}</label>	
					</div>
					</td>
					<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center">{{ __('Miktar:  ') }}{{ $kgsevk->miktar ?? ''}} {{ $kgsevk->unit->name ?? ''}}</label>	
					</div>
					</td>
					<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center">{{ __('Fiyat:  ') }}{{ $kgsevk->fiyat ?? ''}}</label>	
					</div>
					</td>
					</tr>
					<tr>
						<td colspan="2"></td>
					<td>
					<div>
						<label for="order_no" class="col-md-12 col-form-label text-md-center">{{ __('Tutar:  ') }}{{ $kgsevk->fiyat * $kgsevk->miktar ?? ''}}</label>	
					</div>
					</td>
				</tr>				
					</table>
				
			</div>
		</div>
	</div>
</div>
@endsection
