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
				<div class="card-header">{{ __('Firma Detayı') }}</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="card-body">
					<table class="table"> 
					<tr><td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('Firma Adı:  ') }}{{ $firma->name }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="unvan" class="col-md-6 col-form-label text-md-center">{{ __('Ünvan:  ') }}{{ $firma->unvan }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="vergidairesi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Dairesi:  ') }}{{ $firma->vergidairesi }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="verginumarasi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Numarası:  ') }}{{ $firma->verginumarasi }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="tel1" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 1  :')   }}{{ $firma->tel1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="tel2" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 2  :')   }}{{ $firma->tel2 }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="fax1" class="col-md-6 col-form-label text-md-center">{{ __('Fax 1  :  ') }}{{ $firma->fax1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="fax2" class="col-md-6 col-form-label text-md-center">{{ __('Fax 2  :  ') }}{{ $firma->fax2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="email1" class="col-md-6 col-form-label text-md-center">{{ __('Email 1  :  ') }}{{ $firma->email1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="email2" class="col-md-6 col-form-label text-md-center">{{ __('Email 2  :  ') }}{{ $firma->email2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="adres1" class="col-md-6 col-form-label text-md-center">{{ __('Adres 1  :  ') }}{{ $firma->adres1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="adres2" class="col-md-6 col-form-label text-md-center">{{ __('Adres 2  :  ') }}{{ $firma->adres2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="country" class="col-md-6 col-form-label text-md-center">{{ __('Ülke  :  ') }}{{ $firma->country->name }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="city" class="col-md-6 col-form-label text-md-center">{{ __('Şehir  :  ') }}{{ $firma->city->name }}</label>	
					</div></td></tr>	
					<tr><td>	
					<div class="form-group row">
						<label for="banka" class="col-md-6 col-form-label text-md-center">{{ __('Banka  :  ') }}{{ $firma->banka }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="sube" class="col-md-6 col-form-label text-md-center">{{ __('Şube  :  ') }}{{ $firma->sube }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="hesapno" class="col-md-6 col-form-label text-md-center">{{ __('Hesap NO  :  ') }}{{ $firma->hesapno }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="iban" class="col-md-6 col-form-label text-md-center">{{ __('İban  :  ') }}{{ $firma->iban }}</label>	
					</div></td></tr>
					  <tr>
                                <td>
                                    <div class="form-group row">
                                        <label for="firma_limit"
                                               class="col-md-6 col-form-label text-md-center">{{ __('Firma Limit  :')   }}{{ $firma->firma_limit }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group row">
										<label for="personel" class="col-md-6 col-form-label text-md-center">{{ __('Personel  :  ') }}{{ $firma->personel->name ?? ''}}</label>	
                                    </div>
                                </td>
                            </tr>
					<tr><td>	
					<div class="form-group row">
						<label for="website" class="col-md-6 col-form-label text-md-center">{{ __('Web Site  :  ') }}{{ $firma->website }}</label>	
					</div></td><td>		
					<div class="form-group row">
						<label for="aciklama" class="col-md-6 col-form-label text-md-center">{{ __('Açıklama  :  ') }}{{ $firma->aciklama }}</label>	
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
