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
				<div class="card-header">{{ __('Ürün Detayı') }}</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body">
					<table class="table"> 
						<tr><td colspan="3">
					<div class="form-group row">
						<label for="no" class="col-md-12 col-form-label text-md-center">{{ __('Ürün Adı:  ') }}{{ $urun->name }}</label>	
					</div>
					</td>
					</tr>
					<tr><td>
					<div class="form-group row">
						<label for="no" class="col-md-6 col-form-label text-md-center">{{ __('Kod:  ') }}{{ $urun->no }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="barkod" class="col-md-6 col-form-label text-md-center">{{ __('Barkod:  ') }}{{ $urun->barkod }}</label>	
					</div></td>
					<td>
					<div class="form-group row">
						<label for="urunaltkategori_id" class="col-md-6 col-form-label text-md-center">{{ __('Alt Kategori:  ') }}{{ $urun->urunaltkategori->name }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="ebat_id" class="col-md-6 col-form-label text-md-center">{{ __('Ebat:  ') }}@isset($urun->ebat->name){{ $urun->ebat->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="model" class="col-md-6 col-form-label text-md-center">{{ __('Model :')   }}@isset($urun->models->name ){{ $urun->models->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="tel2" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Özelliği 1 : ')   }}@isset($urun->urunozellik1->name){{ $urun->urunozellik1->name }}@endisset</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="fax1" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Özelliği 2 :  ') }}@isset($urun->urunozellik2->name){{ $urun->urunozellik2->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="fax2" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Özelliği 3 :  ') }}@isset($urun->urunozellik3->name){{ $urun->urunozellik3->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="email1" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Özelliği 4 :  ') }}@isset($urun->urunozellik4->name){{ $urun->urunozellik4->name }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="email2" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Özelliği 5 :  ') }}@isset($urun->urunozellik5->name){{ $urun->urunozellik5->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="adres1" class="col-md-6 col-form-label text-md-center">{{ __('Birim  :  ') }}@isset($urun->unit->name){{ $urun->unit->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="banka" class="col-md-6 col-form-label text-md-center">{{ __('Paket İçi Adet  :  ') }}{{ $urun->paketiciadet }}</label>		
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="koliiciadet" class="col-md-6 col-form-label text-md-center">{{ __('Koli İçi Adet  :  ') }}{{ $urun->koliiciadet }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="ambalajtur" class="col-md-6 col-form-label text-md-center">{{ __('Ambalaj Türü  :  ') }}@isset($urun->ambalajtur->name){{ $urun->ambalajtur->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="paketiciozellik" class="col-md-6 col-form-label text-md-center">{{ __('Paket İçi Özellik  :  ') }}@isset($urun->paketiciozellik->name){{ $urun->paketiciozellik->name }}@endisset</label>
					</div></td></tr>	
					<tr><td>	
					<div class="form-group row">
						<label for="renk1_id" class="col-md-6 col-form-label text-md-center">{{ __('Renk 1  :  ') }}@isset($urun->renk1->name){{ $urun->renk1->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="renk" class="col-md-6 col-form-label text-md-center">{{ __('Renk 2 :  ') }}@isset($urun->renk2->name){{ $urun->renk2->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="renk" class="col-md-6 col-form-label text-md-center">{{ __('Renk 3 :  ') }}@isset($urun->renk3->name){{ $urun->renk3->name }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="hacim" class="col-md-6 col-form-label text-md-center">{{ __('Hacim :  ') }}@isset($urun->hacim){{ $urun->hacim }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="gramaj" class="col-md-6 col-form-label text-md-center">{{ __('Gramaj :  ') }}@isset($urun->gramaj){{ $urun->gramaj }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="asgaristok" class="col-md-6 col-form-label text-md-center">{{ __('Asgari Stok :  ') }}@isset($urun->asgaristok){{ $urun->asgaristok }}@endisset</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="ipliktur" class="col-md-6 col-form-label text-md-center">{{ __('İplik Türü :  ') }}@isset($urun->ipliktur){{ $urun->ipliktur }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="ticarikod" class="col-md-6 col-form-label text-md-center">{{ __('A. Ticari Kod :  ') }}@isset($urun->ticarikod){{ $urun->ticarikod}}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="ticariad" class="col-md-6 col-form-label text-md-center">{{ __('A. Ticari Ad :  ') }}@isset($urun->ticariad){{ $urun->ticariad}}@endisset</label>	
					</div></td></tr>
					<tr>
						<td>
							<div class="form-group row">
						<label for="tmkod" class="col-md-6 col-form-label text-md-center">{{ __('T. Ticari Kod :  ') }}@isset($urun->tmkod){{ $urun->tmkod}}@endisset</label>	
							</div>
						</td>
						<td>
							<div class="form-group row">
						<label for="tmad" class="col-md-6 col-form-label text-md-center">{{ __('T. Ticari Ad :  ') }}@isset($urun->tmad){{ $urun->tmad}}@endisset</label>	
							</div>
						</td>
						<td></td>
					</tr>
					<tr><td>	
					<div class="form-group row">
						<label for="urunturu_id" class="col-md-6 col-form-label text-md-center">{{ __('Ürün Türü :  ') }}@isset($urun->urunturu->name){{ $urun->urunturu->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="durum" class="col-md-6 col-form-label text-md-center">{{ __('Durum :  ') }}@isset($urun->durum->name){{ $urun->durum->name }}@endisset</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="icerik" class="col-md-6 col-form-label text-md-center">{{ __('İçerik :  ') }}@isset($urun->icerik){{ $urun->icerik }}@endisset</label>	
					</div></td></tr>
					<tr><td colspan="3">		
					<div class="form-group row">
						<label for="aciklama" class="col-md-12 col-form-label text-md-left">{{ __('Açıklama  :  ') }}{{ $urun->aciklama }}</label>	
					</div></td></tr>
					<tr><td colspan="2">	
					<div class="form-group row">
						<a href="javascript:history.back()" class="btn btn-primary">Geri</a>
					</div></td></tr>					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
