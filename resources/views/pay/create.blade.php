@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ödeme(Cari)') }}</div>

                @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('pay.store') }}">
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
                                <label for="trh" class="col-md-4 col-form-label text-md-right">{{ __('Tarih') }}</label>

                                <div class="col-md-6">

                                    <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" value="{{ old('trh') }}"  autocomplete="trh" autofocus>
                                    @error('trh')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>
                               </textarea>
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
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#firma_id').select2();
    </script>
@endsection
