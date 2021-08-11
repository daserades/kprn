@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Bot lu Üretim') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('uretimbotstore') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="urun_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün') }}</label>

                            <div class="col-md-6">
                                <select name='urun_id' id="urun_id" class="form-control  @error('urun_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($urun as $list)
                                    <option value="{{$list->id}}">{{$list->no ?? ''}} {{$list->name ?? ''}}</option>
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
                            <label for="boticiadet" class="col-md-4 col-form-label text-md-right">{{ __('Bot İçi Adet') }}</label>

                            <div class="col-md-6">

                                <input id="boticiadet" type="text" class="form-control @error('boticiadet') is-invalid @enderror" name="boticiadet" value="{{ old('boticiadet') }}"  autocomplete="boticiadet" autofocus>
                                @error('boticiadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="botadet" class="col-md-4 col-form-label text-md-right">{{ __('Bot Sayısı') }}</label>

                            <div class="col-md-6">

                                <input id="botadet" type="number" step=".001" class="form-control @error('botadet') is-invalid @enderror" name="botadet" value="{{ old('botadet') }}"  autocomplete="botadet" autofocus>
                                @error('botadet')
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
                                {{ __('Oluştur ve  Etiket Bas') }}
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
    $('#urun_id').select2({ width: '500px' });
});
</script>
@endsection