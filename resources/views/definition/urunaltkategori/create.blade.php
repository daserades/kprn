@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Alt Kategori Ekleme') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form id ="myform" method="POST" action="{{ route('urunaltkategori.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('İsmi') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                                <label for="urunkategori_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürun Kategori') }}</label>

                                 <div class="col-md-6">
                                    <select name='urunkategori_id' class="form-control  @error('urunkategori_id') is-invalid @enderror"  style = "position: relative" onchange="change()" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunkategori as $list)
                                            <option value="{{$list->id}}" id="urunkategori_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunkategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
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
@section('js')
@endsection
