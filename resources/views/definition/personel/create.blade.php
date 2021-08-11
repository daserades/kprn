@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Personel Ekle') }}</div>

                     @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('personel.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Ad') }}</label>

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
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Soyad') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                             <div class="form-group row">
                                <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                                <div class="col-md-6">

                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}"  autocomplete="tel" autofocus placeholder="5554443322">
                                    @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                           <div class="form-group row">
                                <label for="departman_id" class="col-md-4 col-form-label text-md-right">{{ __('Departman') }}</label>

                                <div class="col-md-6">
                                    <select name='departman_id' class="form-control  @error('departman_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($departman as $list)
                                            <option value="{{$list->id}}" id="departman_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('departman_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="gorevlistesis_id" class="col-md-4 col-form-label text-md-right">{{ __('Görev Listesi') }}</label>

                                <div class="col-md-6">
                                    <select name='gorevlistesis_id' class="form-control  @error('gorevlistesis_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($gorevlistesi as $list)
                                            <option value="{{$list->id}}" id="gorevlistesis_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('gorevlistesis_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gtrh" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh" value="{{ old('gtrh') }}" required autocomplete="gtrh" autofocus>
                                    @error('gtrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="ctrh" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="{{ old('ctrh') }}" autocomplete="ctrh" autofocus>
                                    @error('ctrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="durums_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='durums_id' class="form-control @error('durums_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durums_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                         @error('durums_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="users_id" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adı') }}</label>

                                <div class="col-md-6">
                                    <select name='users_id' class="form-control @error('users_id') is-invalid @enderror" required>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($user as $user)
                                            <option value="{{$user->id}}" id="users_id">{{$user->username}}</option>
                                        @endforeach
                                    </select>
                                         @error('users_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adres" class="col-md-4 col-form-label text-md-right">{{ __('Adres') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres" type="text" class="form-control"  name="adres"  autocomplete="adres" autofocus>
                                    </textarea>
                                    </div>
                            </div> 
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Personel Ekle') }}
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