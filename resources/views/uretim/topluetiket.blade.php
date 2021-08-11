@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Toplu Etiket Çıkartma Ekranı') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('etiket') }}">
                        @csrf
                        <div class="form-group row">
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label">{{ $urun->no.' '.$urun->name }}</label>
                            <input type="hidden" name="urun_id" value="{{$id}}">
                        </div>
                            <label for="sayi" class="col-md-4 col-form-label text-md-right">{{ __('Etiket Sayısını Giriniz') }}</label>

                            <div class="col-md-6">
                                <input id="sayi" type="number" min="0" class="form-control @error('sayi') is-invalid @enderror" name="sayi" value="{{ old('sayi') }}" required autocomplete="sayi" autofocus>

                                @error('sayi')
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
                                    {{ __('Etiket Bas') }}
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
