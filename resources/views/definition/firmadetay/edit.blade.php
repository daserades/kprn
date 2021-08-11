@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Firma Detay Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('firmadetay.update', $firmadetay->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="{{$firmadetay->firma_id ?? ''}}">{{$firmadetay->firma->name ?? ''}}</option>
                                        @foreach ($firma as $list)
                                            <option value="{{$list->id ?? ''}}" id="firma_id">{{$list->name ?? ''}}</option>
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
                            <label for="vade" class="col-md-4 col-form-label text-md-right">{{ ('Vade') }}</label>

                            <div class="col-md-6">
                                <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade" autocomplete="vade" value="{{$firmadetay->vade}}" autofocus>

                                @error('vade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="iskonta" class="col-md-4 col-form-label text-md-right">{{ ('İskonta') }}</label>

                            <div class="col-md-6">
                                <input id="iskonta" type="text" class="form-control @error('iskonta') is-invalid @enderror" name="iskonta" autocomplete="iskonta" value="{{$firmadetay->iskonta}}" autofocus>

                                @error('iskonta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="limit" class="col-md-4 col-form-label text-md-right">{{ ('Limit') }}</label>

                            <div class="col-md-6">
                                <input id="limit" type="text" class="form-control @error('limit') is-invalid @enderror" name="limit" autocomplete="limit" value="{{$firmadetay->limit ?? ''}}" autofocus>

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
