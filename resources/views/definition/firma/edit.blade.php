@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Firma Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('firma.update', $firma->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Ad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" value="{{$firma->name}}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="firmatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='firmatipi_id' class="form-control  @error('firmatipi_id') is-invalid @enderror" required>
                                            <option value="{{$firma->firmatipi_id ?? ''}}">{{$firma->firmatipi->name ?? ''}}</option>
                                        @foreach ($firmatipi as $list)
                                            <option value="{{$list->id}}" id="firmatipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firmatipi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="unvan" class="col-md-4 col-form-label text-md-right">{{ ('Ünvan') }}</label>

                            <div class="col-md-6">
                                <input id="unvan" type="text" class="form-control @error('unvan') is-invalid @enderror" name="unvan" autocomplete="unvan" value="{{$firma->unvan}}" autofocus>

                                @error('unvan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vergidairesi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Dairesi') }}</label>

                            <div class="col-md-6">
                                <input id="vergidairesi" type="text" class="form-control @error('vergidairesi') is-invalid @enderror" name="vergidairesi" autocomplete="vergidairesi" value="{{$firma->vergidairesi}}" autofocus>

                                @error('vergidairesi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verginumarasi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Numarası') }}</label>

                            <div class="col-md-6">
                                <input id="verginumarasi" type="text" class="form-control @error('verginumarasi') is-invalid @enderror" name="verginumarasi" autocomplete="verginumarasi" value="{{$firma->verginumarasi}}" autofocus>

                                @error('verginumarasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel1" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 1') }}</label>

                            <div class="col-md-6">
                                <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1"  autocomplete="tel1" value="{{$firma->tel1}}" autofocus>

                                @error('tel1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel2" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 2') }}</label>

                            <div class="col-md-6">
                                <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2"  autocomplete="tel2" value="{{$firma->tel2}}" autofocus>

                                @error('tel2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax1" class="col-md-4 col-form-label text-md-right">{{ ('Fax 1') }}</label>

                            <div class="col-md-6">
                                <input id="fax1" type="text" class="form-control @error('fax1') is-invalid @enderror" name="fax1" autocomplete="fax1" value="{{$firma->fax1}}" autofocus>

                                @error('fax1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax2" class="col-md-4 col-form-label text-md-right">{{ ('Fax 2') }}</label>

                            <div class="col-md-6">
                                <input id="fax2" type="text" class="form-control @error('fax2') is-invalid @enderror" name="fax2" autocomplete="fax2" value="{{$firma->fax2}}" autofocus>

                                @error('fax2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="adres1" class="col-md-4 col-form-label text-md-right">{{ __('Adres 1') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres1" type="text" class="form-control"  name="adres1" autocomplete="adres1" autofocus>{{$firma->adres1}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label for="adres2" class="col-md-4 col-form-label text-md-right">{{ __('Adres 2') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres2" type="text" class="form-control"  name="adres2" autocomplete="adres2" autofocus>{{$firma->adres2}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label for="countries_id" class="col-md-4 col-form-label text-md-right">{{ __('Ülke') }}</label>

                                <div class="col-md-6">
                                    <select name='countries_id' id="countries_id" class="form-control  @error('countries_id') is-invalid @enderror">
                                            <option value="{{$firma->countries_id ?? ''}}">{{$firma->country->name ?? ''}}</option>
                                        @foreach ($country as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('countries_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="cities_id" class="col-md-4 col-form-label text-md-right">{{ __('Şehir') }}</label>

                                <div class="col-md-6">
                                    <select name='cities_id' id="cities_id" class="form-control  @error('cities_id') is-invalid @enderror">
                                            <option value="{{$firma->cities_id ?? ''}}">{{$firma->city->name ?? ''}}</option>
                                        @foreach ($city as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('cities_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="banka" class="col-md-4 col-form-label text-md-right">{{ ('Banka') }}</label>

                            <div class="col-md-6">
                                <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" autocomplete="banka" value="{{$firma->banka}}" autofocus>

                                @error('banka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sube" class="col-md-4 col-form-label text-md-right">{{ ('Şube') }}</label>

                            <div class="col-md-6">
                                <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" autocomplete="sube" value="{{$firma->sube}}" autofocus>

                                @error('sube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hesapno" class="col-md-4 col-form-label text-md-right">{{ ('Hesap No') }}</label>

                            <div class="col-md-6">
                                <input id="hesapno" type="text" class="form-control @error('hesapno') is-invalid @enderror" name="hesapno" autocomplete="hesapno" value="{{$firma->hesapno}}" autofocus>

                                @error('hesapno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ ('İban') }}</label>

                            <div class="col-md-6">
                                <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" autocomplete="iban" value="{{$firma->iban}}" autofocus>

                                @error('iban')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ ('Web Site') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" autocomplete="website" value="{{$firma->website}}" autofocus>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="durums_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='durums_id' class="form-control  @error('durums_id') is-invalid @enderror">
                                            <option value="{{$firma->durums_id ?? ''}}">{{$firma->durum->name ?? ''}}</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durums_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('durums_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="alicisatici_id" class="col-md-4 col-form-label text-md-right">{{ __('Kargo Ücreti') }}</label>

                                <div class="col-md-6">
                                    <select name='alicisatici_id' class="form-control  @error('alicisatici_id') is-invalid @enderror">
                                            <option value="{{$firma->alicisatici_id ?? ''}}">@isset($firma->alicisatici->name){{$firma->alicisatici->name ?? ''}}@endisset</option>
                                        @foreach ($alicisatici as $list)
                                            <option value="{{$list->id}}" id="alicisatici_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('alicisatici_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="nakliye1_id" class="col-md-4 col-form-label text-md-right">{{ __('Nakliye1') }}</label>

                                <div class="col-md-6">
                                    <select name='nakliye1_id' class="form-control  @error('nakliye1_id') is-invalid @enderror">
                                            <option value="{{$firma->nakliye1_id}}">@isset($nakliye1->name){{$nakliye1->name}} @endisset</option>
                                        @foreach ($nakliye as $list)
                                            <option value="{{$list->id}}" id="nakliye1_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('nakliye1_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="nakliye2_id" class="col-md-4 col-form-label text-md-right">{{ __('Nakliye2') }}</label>

                                <div class="col-md-6">
                                    <select name='nakliye2_id' class="form-control  @error('nakliye2_id') is-invalid @enderror">
                                            <option value="{{$firma->nakliye2_id ?? ''}}">@isset($nakliye2->name){{$nakliye2->name ?? ''}}@endisset</option>
                                        @foreach ($nakliye as $list)
                                            <option value="{{$list->id}}" id="nakliye2_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('nakliye2_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="faturatipi_id" class="col-md-4 col-form-label text-md-right">{{ __('Fatura tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='faturatipi_id' class="form-control  @error('faturatipi_id') is-invalid @enderror">
                                            <option value="{{$firma->faturatipi_id}}">@isset($firma->faturatipi->name){{$firma->faturatipi->name}}@endisset</option>
                                        @foreach ($faturatipi as $list)
                                            <option value="{{$list->id}}" id="faturatipi_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('faturatipi_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="ticarikod" class="col-md-4 col-form-label text-md-right">{{ ('TicariKod') }}</label>

                            <div class="col-md-6">
                                <input id="ticarikod" type="text" class="form-control @error('ticarikod') is-invalid @enderror" name="ticarikod" autocomplete="ticarikod" value="{{$firma->ticarikod}}" autofocus>

                                @error('ticarikod')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firma_limit" class="col-md-4 col-form-label text-md-right">{{ ('Firma Limit') }}</label>

                            <div class="col-md-6">
                                <input id="firma_limit" type="text" class="form-control @error('firma_limit') is-invalid @enderror" name="firma_limit" autocomplete="firma_limit" value="{{$firma->firma_limit}}" autofocus>

                                @error('firma_limit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personel_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Sorumlusu') }}</label>

                            <div class="col-md-6">
                                <select name='personel_id' class="form-control  @error('personel_id') is-invalid @enderror">
                                    <option value="{{$firma->personel_id ?? ''}}">{{$firma->personel->name ?? ''}}</option>
                                    @foreach ($personel as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('personel_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror">
                                            <option value="{{$firma->kur_id}}">@isset($firma->kur->name){{$firma->kur->name}}@endisset</option>
                                        @foreach ($kur as $list)
                                            <option value="{{$list->id}}" id="kur_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('kur_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$firma->aciklama}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Güncelle') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
    
    $('#countries_id, #cities_id').select2({ width: '350px' });

</script>
@endsection



