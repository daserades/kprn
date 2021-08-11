@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Standart dışı Sevk Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('kgsevkstore') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                 <div class="col-md-6">
                                    <select name='firma_id' id="firma_id" class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('firma_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="urun_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün') }}</label>

                                 <div class="col-md-6">
                                    <select name='urun_id' id="urun_id" class="form-control  @error('urun_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urun as $list)
                                            <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urun_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                             <div class="form-group row">
                                <label for="miktar" class="col-md-4 col-form-label text-md-right">{{ __('Miktar') }}</label>

                                <div class="col-md-6">

                                    <input id="miktar" type="text" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ old('miktar') }}"  autocomplete="miktar" autofocus placeholder="miktar">
                                    @error('miktar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="brutmiktar" class="col-md-4 col-form-label text-md-right">{{ __('Brüt Miktar') }}</label>

                                <div class="col-md-6">

                                    <input id="brutmiktar" type="text" class="form-control @error('brutmiktar') is-invalid @enderror" name="brutmiktar" value="{{ old('brutmiktar') }}"  autocomplete="brutmiktar" autofocus placeholder="brutmiktar">
                                    @error('brutmiktar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Birim') }}</label>

                                <div class="col-md-6">
                                    <select name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($unit as $list)
                                            <option value="{{$list->id}}" id="unit_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fiyat" class="col-md-4 col-form-label text-md-right">{{ __('Fiyat') }}</label>

                                <div class="col-md-6">

                                    <input id="fiyat" type="text" class="form-control @error('fiyat') is-invalid @enderror" name="fiyat" value="{{ old('fiyat') }}"  autocomplete="fiyat" autofocus placeholder="fiyat">
                                    @error('fiyat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Ekle') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
$( function() {
    $('#urun_id,#firma_id').select2({ width: '350px' });
});
</script>
@endsection