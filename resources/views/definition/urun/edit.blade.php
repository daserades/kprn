@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ürün Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('urun.update', $urun->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="no" class="col-md-4 col-form-label text-md-right">{{ ('Kod') }}</label>

                            <div class="col-md-6">
                                <input id="no" type="text" class="form-control @error('no') is-invalid @enderror" name="no" autocomplete="no" value="{{$urun->no}}" autofocus>

                                @error('no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="barkod" class="col-md-4 col-form-label text-md-right">{{ ('Barkod') }}</label>

                            <div class="col-md-6">
                                <input id="barkod" type="text" class="form-control @error('barkod') is-invalid @enderror" name="barkod" autocomplete="barkod" value="{{$urun->barkod}}" autofocus>

                                @error('barkod')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="urunaltkategori_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Kategori') }}</label>

                                <div class="col-md-6">
                                    <select name='urunaltkategori_id' class="form-control  @error('urunaltkategori_id') is-invalid @enderror">
                                            <option value="{{$urun->urunaltkategori_id}}">@isset($urun->urunaltkategori->name){{$urun->urunaltkategori->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunaltkategori as $list)
                                            <option value="">Seçiniz..</option>
                                            <option value="{{$list->id}}" id="urunaltkategori_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunaltkategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="ebat_id" class="col-md-4 col-form-label text-md-right">{{ __('Ebat') }}</label>

                                <div class="col-md-6">
                                    <select name='ebat_id' class="form-control  @error('ebat_id') is-invalid @enderror">
                                            <option value="{{$urun->ebat_id}}">@isset($urun->ebat->name){{$urun->ebat->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($ebat as $list)
                                            <option value="{{$list->id}}" id="ebat_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('ebat_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                                <label for="models_id" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>

                                <div class="col-md-6">
                                    <select name='models_id' class="form-control  @error('models_id') is-invalid @enderror">
                                            <option value="{{$urun->models_id}}">@isset($urun->models->name){{$urun->models->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($models as $list)
                                            <option value="{{$list->id}}" id="models_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('models_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="urunozellik1_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Özelliği') }}</label>

                                <div class="col-md-6">
                                    <select name='urunozellik1_id' class="form-control  @error('urunozellik1_id') is-invalid @enderror">
                                            <option value="{{$urun->urunozellik1_id}}">@isset($urun->urunozellik1->name){{$urun->urunozellik1->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunozellik as $list)
                                            <option value="{{$list->id}}" id="urunozellik1_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunozellik1_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="urunozellik2_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Özelliği') }}</label>

                                <div class="col-md-6">
                                    <select name='urunozellik2_id' class="form-control  @error('urunozellik2_id') is-invalid @enderror">
                                            <option value="{{$urun->urunozellik2_id}}">@isset($urun->urunozellik2->name){{$urun->urunozellik2->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunozellik as $list)
                                            <option value="{{$list->id}}" id="urunozellik2_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunozellik2_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="urunozellik3_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Özelliği') }}</label>

                                <div class="col-md-6">
                                    <select name='urunozellik3_id' class="form-control  @error('urunozellik3_id') is-invalid @enderror">
                                            <option value="{{$urun->urunozellik3_id}}">@isset($urun->urunozellik3->name){{$urun->urunozellik3->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunozellik as $list)
                                            <option value="{{$list->id}}" id="urunozellik3_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunozellik3_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="urunozellik4_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Özelliği') }}</label>

                                <div class="col-md-6">
                                    <select name='urunozellik4_id' class="form-control  @error('urunozellik4_id') is-invalid @enderror">
                                            <option value="{{$urun->urunozellik4_id}}">@isset($urun->urunozellik4->name){{$urun->urunozellik4->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunozellik as $list)
                                            <option value="{{$list->id}}" id="urunozellik4_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunozellik4_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="urunozellik5_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Özelliği') }}</label>

                                <div class="col-md-6">
                                    <select name='urunozellik5_id' class="form-control  @error('urunozellik5_id') is-invalid @enderror">
                                            <option value="{{$urun->urunozellik5_id}}">@isset($urun->urunozellik5->name){{$urun->urunozellik5->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunozellik as $list)
                                            <option value="{{$list->id}}" id="urunozellik5_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunozellik5_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Birim') }}</label>

                                <div class="col-md-6">
                                    <select name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror">
                                            <option value="{{$urun->unit_id}}">@isset($urun->unit->name){{$urun->unit->name}}@endisset</option>
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
                            <label for="paketiciadet" class="col-md-4 col-form-label text-md-right">{{ ('Paket İçi Adet') }}</label>

                            <div class="col-md-6">
                                <input id="paketiciadet" type="text" class="form-control @error('paketiciadet') is-invalid @enderror" name="paketiciadet" autocomplete="paketiciadet" value="{{$urun->paketiciadet}}" autofocus>

                                @error('paketiciadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="koliiciadet" class="col-md-4 col-form-label text-md-right">{{ ('Koli İçi Adet') }}</label>

                            <div class="col-md-6">
                                <input id="koliiciadet" type="text" class="form-control @error('koliiciadet') is-invalid @enderror" name="koliiciadet" autocomplete="koliiciadet" value="{{$urun->koliiciadet}}" autofocus>

                                @error('koliiciadet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="ambalajtur_id" class="col-md-4 col-form-label text-md-right">{{ __('Ambalaj Türü') }}</label>

                                <div class="col-md-6">
                                    <select name='ambalajtur_id' class="form-control  @error('ambalajtur_id') is-invalid @enderror">
                                            <option value="{{$urun->ambalajtur_id}}">@isset($urun->ambalajtur->name){{$urun->ambalajtur->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($ambalajtur as $list)
                                            <option value="{{$list->id}}" id="ambalajtur_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('ambalajtur_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="paketiciozellik_id" class="col-md-4 col-form-label text-md-right">{{ __('Paket İçi Özelllik') }}</label>

                                <div class="col-md-6">
                                    <select name='paketiciozellik_id' class="form-control  @error('paketiciozellik_id') is-invalid @enderror">
                                            <option value="{{$urun->paketiciozellik_id}}">@isset($urun->paketiciozellik->name){{$urun->paketiciozellik->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($paketiciozellik as $list)
                                            <option value="{{$list->id}}" id="paketiciozellik_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('paketiciozellik_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk1_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk1_id' class="form-control  @error('renk1_id') is-invalid @enderror">
                                            <option value="{{$urun->renk1_id}}">@isset($urun->renk1->name){{$urun->renk1->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk1_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk1_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk2_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk2_id' class="form-control  @error('renk2_id') is-invalid @enderror">
                                            <option value="{{$urun->renk2_id}}">@isset($urun->renk2->name){{$urun->renk2->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk2_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk2_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk3_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk3_id' class="form-control  @error('renk3_id') is-invalid @enderror">
                                            <option value="{{$urun->renk3_id}}">@isset($urun->renk3->name){{$urun->renk3->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk3_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk3_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk4_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk4_id' class="form-control  @error('renk4_id') is-invalid @enderror">
                                            <option value="{{$urun->renk4_id}}">@isset($urun->renk4->name){{$urun->renk4->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk4_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk4_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk5_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk5_id' class="form-control  @error('renk5_id') is-invalid @enderror">
                                            <option value="{{$urun->renk5_id}}">@isset($urun->renk5->name){{$urun->renk5->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk5_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk5_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="renk6_id" class="col-md-4 col-form-label text-md-right">{{ __('Renk') }}</label>

                                <div class="col-md-6">
                                    <select name='renk6_id' class="form-control  @error('renk6_id') is-invalid @enderror">
                                            <option value="{{$urun->renk6_id}}">@isset($urun->renk6->name){{$urun->renk6->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($renk as $list)
                                            <option value="{{$list->id}}" id="renk6_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('renk6_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="hacim" class="col-md-4 col-form-label text-md-right">{{ ('Hacim') }}</label>

                            <div class="col-md-6">
                                <input id="hacim" type="text" class="form-control @error('hacim') is-invalid @enderror" name="hacim"  autocomplete="hacim" value="{{$urun->hacim}}" autofocus>

                                @error('hacim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gramaj" class="col-md-4 col-form-label text-md-right">{{ ('Gramaj') }}</label>

                            <div class="col-md-6">
                                <input id="gramaj" type="text" class="form-control @error('gramaj') is-invalid @enderror" name="gramaj"  autocomplete="gramaj" value="{{$urun->gramaj}}" autofocus>

                                @error('gramaj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="asgaristok" class="col-md-4 col-form-label text-md-right">{{ ('Asgari Stok') }}</label>

                            <div class="col-md-6">
                                <input id="asgaristok" type="text" class="form-control @error('asgaristok') is-invalid @enderror" name="asgaristok" autocomplete="asgaristok" value="{{$urun->asgaristok}}" autofocus>

                                @error('asgaristok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ipliktur" class="col-md-4 col-form-label text-md-right">{{ ('İplik Tür') }}</label>

                            <div class="col-md-6">
                                <input id="ipliktur" type="text" class="form-control @error('ipliktur') is-invalid @enderror" name="ipliktur" autocomplete="ipliktur" value="{{$urun->ipliktur}}" autofocus>

                                @error('ipliktur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="icerik" class="col-md-4 col-form-label text-md-right">{{ __('İçerik') }}</label>
                                <div class="col-md-6">
                                     <textarea id="icerik" type="text" class="form-control"  name="icerik" autocomplete="icerik" autofocus>{{$urun->icerik}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$urun->aciklama}}
                                    </textarea>
                                    </div>
                        </div>
                        <div class="form-group row">
                            <label for="ticarikod" class="col-md-4 col-form-label text-md-right">{{ ('Ticari Kod') }}</label>

                            <div class="col-md-6">
                                <input id="ticarikod" type="text" class="form-control @error('ticarikod') is-invalid @enderror" name="ticarikod" autocomplete="ticarikod" value="{{$urun->ticarikod}}" autofocus>

                                @error('ticarikod')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ticariad" class="col-md-4 col-form-label text-md-right">{{ ('Ticari Ad') }}</label>

                            <div class="col-md-6">
                                <input id="ticariad" type="text" class="form-control @error('ticariad') is-invalid @enderror" name="ticariad" autocomplete="ticariad" value="{{$urun->ticariad}}" autofocus>

                                @error('ticariad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tmkod" class="col-md-4 col-form-label text-md-right">{{ ('TM Kod') }}</label>

                            <div class="col-md-6">
                                <input id="tmkod" type="text" class="form-control @error('tmkod') is-invalid @enderror" name="tmkod" autocomplete="tmkod" value="{{$urun->tmkod}}" autofocus>

                                @error('tmkod')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tmad" class="col-md-4 col-form-label text-md-right">{{ ('TM Ad') }}</label>

                            <div class="col-md-6">
                                <input id="tmad" type="text" class="form-control @error('tmad') is-invalid @enderror" name="tmad" autocomplete="tmad" value="{{$urun->tmad}}" autofocus>

                                @error('tmad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="urunturu_id" class="col-md-4 col-form-label text-md-right">{{ __('Ürün Türü') }}</label>

                                <div class="col-md-6">
                                    <select name='urunturu_id' class="form-control  @error('urunturu_id') is-invalid @enderror">
                                            <option value="{{$urun->urunturu_id}}">@isset($urun->urunturu->name){{$urun->urunturu->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($urunturu as $list)
                                            <option value="{{$list->id}}" id="urunturu_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('urunturu_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="durum_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='durum_id' class="form-control  @error('durum_id') is-invalid @enderror">
                                            <option value="{{$urun->durum_id}}">@isset($urun->durum->name){{$urun->durum->name}}@endisset</option>
                                            <option value="">Seçiniz..</option>
                                        @foreach ($durum as $list)
                                            <option value="{{$list->id}}" id="durum_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('durum_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn btn-success" type="submit" name="action" value="Güncelle" />
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                             <input class="btn btn-dark" type="submit" name="action" value="Farklı Kaydet" />
                                
{{--                               <button type="submit" class="btn btn-success">--}}
{{--                                    {{ __('Güncelle') }}--}}
{{--                                </button>--}}       
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
