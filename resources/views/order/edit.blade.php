@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sipariş Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('order.update', $order->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                                <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="{{$order->firma_id}}">@isset($order->firma->name){{$order->firma->name}}@endisset</option>
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
                            <label for="sevktrh" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="sevktrh" type="date" class="form-control @error('sevktrh') is-invalid @enderror" name="sevktrh" value="{{ date('Y-m-d',strtotime($order->sevktrh))}}"  autocomplete="sevktrh" autofocus>
                                @error('sevktrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> <div class="form-group row">
                            <label for="vade" class="col-md-4 col-form-label text-md-right">{{ __('Vade') }}</label>

                            <div class="col-md-6">

                                <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade" value="{{ $order->vade }}"  autocomplete="vade" autofocus>
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

                                <input id="iskonta" type="text" class="form-control @error('iskonta') is-invalid @enderror" name="iskonta" value="{{ $order->iskonta }}"  autocomplete="iskonta" autofocus>
                                @error('iskonta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="bazkur" class="col-md-4 col-form-label text-md-right">{{ __('Kur') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="kur_id" value="{{$order->kur_id}}">
                                <input id="bazkur" type="text" class="form-control @error('bazkur') is-invalid @enderror" name="bazkur" value="{{ $order->bazkur }}"  autocomplete="bazkur" autofocus>
                                @error('bazkur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                       <!--  <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror">
                                            <option value="{{$order->kur_id}}">@isset($order->kur->name){{$order->kur->name}}@endisset</option>
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
                                <label for="orderstatuses_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Durumu') }}</label>

                                <div class="col-md-6">
                                    <select name='orderstatuses_id' class="form-control  @error('orderstatuses_id') is-invalid @enderror">
                                            <option value="{{$order->orderstatuses_id}}">@isset($order->orderstatus->name){{$order->orderstatus->name}}@endisset</option>
                                        @foreach ($orderstatus as $list)
                                            <option value="{{$list->id}}" id="orderstatuses_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('orderstatuses_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                            <label for="sevkadres" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Adresi') }}</label>
                            <div class="col-md-6">
                               <textarea id="sevkadres" type="text" class="form-control"  name="sevkadres"  autocomplete="sevkadres" autofocus>{{$order->sevkadres}}
                               </textarea>
                           </div>
                       </div> 
                        <div class="form-group row">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$order->aciklama}}
                               </textarea>
                           </div>
                       </div> 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                 <input class="btn btn-success" type="submit" name="action" value="Güncelle" />
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                             <input class="btn btn-dark" type="submit" name="action" value="Farklı Kaydet" />
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
