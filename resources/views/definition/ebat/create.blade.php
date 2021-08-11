@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ebat Ekleme') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('ebat.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('İsmi') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="en" class="col-md-4 col-form-label text-md-right">{{ __('En') }}</label>

                            <div class="col-md-6">
                                <input id="en" type="text" class="form-control @error('en') is-invalid @enderror" name="en" value="{{ old('en') }}"  autocomplete="en" autofocus>

                                @error('en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="boy" class="col-md-4 col-form-label text-md-right">{{ __('Boy') }}</label>

                            <div class="col-md-6">
                                <input id="boy" type="text" class="form-control @error('boy') is-invalid @enderror" name="boy" value="{{ old('boy') }}"  autocomplete="boy" autofocus>

                                @error('boy')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="yukseklik" class="col-md-4 col-form-label text-md-right">{{ __('Yükseklik') }}</label>

                            <div class="col-md-6">
                                <input id="yukseklik" type="text" class="form-control @error('yukseklik') is-invalid @enderror" name="yukseklik" value="{{ old('yukseklik') }}"  autocomplete="yukseklik" autofocus>

                                @error('yukseklik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="hacim" class="col-md-4 col-form-label text-md-right">{{ __('Hacim') }}</label>

                            <div class="col-md-6">
                                <input id="hacim" type="text" class="form-control @error('hacim') is-invalid @enderror" name="hacim" value="{{ old('hacim') }}"  autocomplete="hacim" autofocus>

                                @error('hacim')
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
</div>
@endsection
