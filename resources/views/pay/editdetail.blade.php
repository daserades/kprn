@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ödeme Güncelle') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('pay.update', $pay->id) }}">
                        @method('PATCH')
                        @csrf
                                {{--
                        <div class="form-group row">
                                 <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='firma_id' class="form-control  @error('firma_id') is-invalid @enderror" required>
                                            <option value="{{$pay->firma_id}}">@isset($pay->firma->name){{$pay->firma->name}}@endisset</option>
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
                            </div> --}}
                            <div class="form-group row">
                                <label for="ship_id" class="col-md-4 col-form-label text-md-right">{{ __('Sevkiyat İrsaliyeleri') }}</label>

                                <div class="col-md-6">
                                    <select name='ship_id' class="form-control  @error('ship_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                            <option value="{{$pay->ship_id}}">@isset($pay->ship->irsaliyeno){{$pay->ship->irsaliyeno}}@endisset</option>
                                        @foreach ($ship as $list)
                                            <option value="{{$list->id}}" id="ship_id">{{$list->irsaliyeno}}</option>
                                        @endforeach
                                    </select>
                                     @error('ship_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="payloadtype_id" class="col-md-4 col-form-label text-md-right">{{ __('Ödeme Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='payloadtype_id' class="form-control  @error('payloadtype_id') is-invalid @enderror">
                                            <option value="{{$pay->payloadtype_id}}">@isset($pay->payloadtype->name){{$pay->payloadtype->name}}@endisset</option>
                                        @foreach ($payloadtype as $list)
                                            <option value="{{$list->id}}" id="payloadtype_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('payloadtype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                        <div class="form-group row">
                            <label for="trh" class="col-md-4 col-form-label text-md-right">{{ __('Tarih') }}</label>

                            <div class="col-md-6">

                                <input id="trh" type="date" class="form-control @error('trh') is-invalid @enderror" name="trh" value="{{ date('Y-m-d',strtotime($pay->trh))}}"  autocomplete="trh" autofocus>
                                @error('trh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vadetrh" class="col-md-4 col-form-label text-md-right">{{ __('Vade Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="vadetrh" type="date" class="form-control @error('vadetrh') is-invalid @enderror" name="vadetrh" value="{{ date('Y-m-d',strtotime($pay->vadetrh))}}"  autocomplete="vadetrh" autofocus>
                                @error('vadetrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>    
                        <div class="form-group row">
                                <label for="kur_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Cinsi') }}</label>

                                <div class="col-md-6">
                                    <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror">
                                            <option value="{{$pay->kur_id}}">@isset($pay->kur->name){{$pay->kur->name}}@endisset</option>
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
                            </div> 
                         <div class="form-group row">
                            <label for="miktar" class="col-md-4 col-form-label text-md-right">{{ __('Miktar') }}</label>

                            <div class="col-md-6">

                                <input id="miktar" type="text" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ $pay->miktar }}"  autocomplete="miktar" autofocus>
                                @error('miktar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="banka" class="col-md-4 col-form-label text-md-right">{{ __('Banka') }}</label>

                            <div class="col-md-6">

                                <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" value="{{ $pay->banka }}"  autocomplete="banka" autofocus>
                                @error('banka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="kesideyeri" class="col-md-4 col-form-label text-md-right">{{ __('Kur') }}</label>

                            <div class="col-md-6">

                                <input id="kesideyeri" type="text" class="form-control @error('kesideyeri') is-invalid @enderror" name="kesideyeri" value="{{ $pay->kesideyeri }}"  autocomplete="kesideyeri" autofocus>
                                @error('kesideyeri')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="sube" class="col-md-4 col-form-label text-md-right">{{ __('Şube') }}</label>

                            <div class="col-md-6">

                                <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" value="{{ $pay->sube }}"  autocomplete="sube" autofocus>
                                @error('sube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="evrakno" class="col-md-4 col-form-label text-md-right">{{ __('Evrak No') }}</label>

                            <div class="col-md-6">

                                <input id="evrakno" type="text" class="form-control @error('evrakno') is-invalid @enderror" name="evrakno" value="{{ $pay->evrakno }}"  autocomplete="evrakno" autofocus>
                                @error('evrakno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$pay->aciklama}}
                               </textarea>
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

@section('js')
    <script type="text/javascript">
        // $("select[name='firma_id']").change(function(){
        //     var sid = $(this).val();
        //     if(sid){
        //         $.ajax({
        //             type:"get",
        //             url:'{{url('/pay/ship')}}/'+sid,
        //             success:function(res)
        //             {     var kayitSay = res.length;
        //                 if(kayitSay > 0)
        //                 {//console.log;
        //                     $("select[name='ship_id").empty();

        //                     for (var i = 0; i < kayitSay; i++)
        //                     {
        //                         $("select[name='ship_id']").append('<option value="'+res[i].id+'">'+res[i].order.no+' İrsaliye No='+res[i].irsaliyeno
        //                             +'</option>');
        //                     }
        //                 }
        //                 else {
        //                      $("select[name='ship_id']").empty();
        //                 }
        //             }
        //         });
        //     }

        // });

    </script>
@endsection
