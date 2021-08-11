@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('errorMsg'))
            <div class="alert alert-icon alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-check-all"></i>
                <center><strong> Hata! </strong>{{session('errorMsg')}}</center>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Parola Güncelleme') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.updatee') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Eski Parola') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" value="{{ old('oldpassword') }}" required autocomplete="oldpassword" autofocus>

                                    @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Parola') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Parola Onayla') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">

                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Parola Güncelle') }}
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