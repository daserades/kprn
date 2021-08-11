@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Firma Detay Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('firmadetay.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                 <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id}}" id="firma_id">{{$list->name}}</option>
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
                                <label for="vade" class="col-md-4 col-form-label text-md-right">{{ __('Vade') }}</label>

                                <div class="col-md-6">

                                    <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade" value="{{ old('vade') }}"  autocomplete="vade" autofocus placeholder="vade">
                                    @error('vade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="iskonta" class="col-md-4 col-form-label text-md-right">{{ __('İskonta') }}</label>

                                <div class="col-md-6">

                                    <input id="iskonta" type="text" class="form-control @error('iskonta') is-invalid @enderror" name="iskonta" value="{{ old('iskonta') }}"  autocomplete="iskonta" autofocus placeholder="iskonta">
                                    @error('iskonta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           <!-- <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Türü') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
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
                            </div> -->
                            <div class="form-group row">
                                <label for="limit" class="col-md-4 col-form-label text-md-right">{{ __('Limit') }}</label>

                                <div class="col-md-6">

                                    <input id="limit" type="text" class="form-control @error('limit') is-invalid @enderror" name="limit" value="{{ old('limit') }}"  autocomplete="limit" autofocus placeholder="limit">
                                    @error('limit')
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