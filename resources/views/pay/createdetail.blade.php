@extends('layouts.app')

@section('content')
    <div >
        <div >
            <div class="col-md-auto">
                <div class="row">
                <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('Fatura Ortalamaları') }}</div>
                    <table border="1" >
                        <thead>
                            <th>İrsaliye No</th>
                            <th>S.Tarih</th>
                            <th>Vade</th>
                            <th>V.Tarih</th>
                            <th>F.Tutar</th>
                        </thead>
                        <tbody>@php $t=0; $p=0; $a=0; $tutar=0; $paid=0; $paiddate=0; $b=0; @endphp
                            @foreach ($ship as $list)
                            @if($list->option==1)
                                <tr>
                                    <td>{{$list->ship->irsaliyeno ?? ''}}</td>
                                    <td>{{ date('d-m-Y',strtotime($list->ship->created_at)) ?? ''}} </td>
                                    <td>{{$list->order->vade ?? ''}} </td>
                                    <td>@isset($list->ship->created_at){{ $a=date('d-m-Y',strtotime($list->ship->created_at->addDays($list->order->vade))) ?? ''}}  @endisset</td>
                                    <td>{{number_format($list->debt,2) ?? ''}} {{$list->kur->name ?? ''}} </td>
                                </tr> 
                                @endif
                                        @php 
                                                if( $list->option == 2 ) 
                                                {
                                                    $b=date('d-m-Y',strtotime($list->vadetrh));
                                                    $paid=$list->paid;
                                                    $paiddate= strtotime($b)*$paid;
                                                    $t -= $paiddate; 
                                                    $p -= $paid;
                                                }
                                         $tutar=$list->debt;  
                                        $c=strtotime($a)* $tutar; 
                                        $t +=$c; $p +=$tutar;
                                         @endphp
                            @endforeach
                            <tr>
                                <td colspan="3">Toplam</td>
                                <td>{{date('d-m-Y',$t/$p)}} </td>
                                <td>{{number_format($p,2)}} </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                </div>
                <div class="col-9">
                <div class="card">
                    <div class="card-header">{{ __('Ödeme Detay') }} <br>
                        <label for="firma_id" class="col-md-3 col-form-label text-md-center">Ödeme No={{ $pay->no ?? ''}}</label>
                         <label for="firma_id" class="col-md-3 col-form-label text-md-center">Firma={{ $pay->firma->name ?? ''}}</label>
                         <label for="firma_id" class="col-md-3 col-form-label text-md-center">Açıklama={{ $pay->aciklama }}</label>
                    </div>
                @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-body">
                         <form method="POST" action="{{ route('storedetail') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pay_id" value="{{$pay->id}} ">
                            <div class="form-group row">
                                {{ __('Tip') }}
                                <div class="col-md-3">
                                    <select name='type_id' id="type_id" class="form-control  @error('type_id') is-invalid @enderror" >
                                        <option value="">Seçiniz..</option>
                                        @foreach($type as $list)
                                            <option value="{{$list->id}} ">{{$list->name}} </option>
                                        @endforeach 
                                    </select>
                                    @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                    @enderror
                                </div>
                               {{--  {{ __('Sevkiyat İrsaliyeleri') }}
                                <div class="col-md-3">
                                    <select name='ship_id[]' id="ship_id" class="form-control  @error('ship_id') is-invalid @enderror" multiple data-live-search="true">
                                        <option value="">Seçiniz..</option>
                                        @foreach($ship as $list)
                                            <option value="{{$list->id}}">{{$list->no ?? ''}}-{{$list->irsaliyeno}} </option>
                                        @endforeach 
                                    </select>
                                    @error('ship_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                    @enderror
                                </div>                          --}}   
                                {{ __('Ödeme Tipi') }}
                                <div class="col-md-3">
                                    <select name='payloadtype_id' class="form-control  @error('payloadtype_id') is-invalid @enderror" required>
                                        <option value="">Seçiniz..</option>
                                        @foreach ($payloadtype as $list)
                                            <option value="{{$list->id}}" id="firma_id">{{$list->name}}</option>
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
                                {{ __('Evrak No') }}
                                <div class="col-md-3">
                                    <input id="evrakno" type="text" class="form-control @error('evrakno') is-invalid @enderror" name="evrakno" value="{{ old('evrakno') }}"  autocomplete="evrakno" autofocus placeholder="Evrak No">
                                    @error('evrakno')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>                            
                                {{ __('Asıl Kişi') }}
                                <div class="col-md-3">
                                    <input id="asilkisi" type="text" class="form-control @error('asilkisi') is-invalid @enderror" name="asilkisi" value="{{ old('asilkisi') }}"  autocomplete="asilkisi" placeholder="Asıl Kişi" autofocus>
                                    @error('asilkisi')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>                            
                                {{ __('Banka') }}
                                <div class="col-md-3">
                                    <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" value="{{ old('banka') }}"  autocomplete="banka" autofocus placeholder="Banka">
                                    @error('banka')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group row">                            
                                {{ __('Vade Tarihi') }}
                                <div class="col-md-3">
                                    <input id="vadetrh" type="date" class="form-control @error('vadetrh') is-invalid @enderror" name="vadetrh" value="{{ old('vadetrh') }}"  autocomplete="vadetrh" autofocus required>
                                    @error('vadetrh')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                {{ __('Miktar') }}
                                <div class="col-md-3">
                                    <input id="miktar" type="number" class="form-control @error('miktar') is-invalid @enderror" name="miktar" value="{{ old('miktar') }}"  autocomplete="miktar" autofocus placeholder="Miktar">
                                    @error('miktar')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>                            
                            {{ __('Döviz Cinsi') }}
                            <div class="col-md-3">
                                <select name='kur_id' class="form-control  @error('kur_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
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
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Ekle') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <th></th>
                                <th>Tip</th>
                                <th>Ödeme Tipi</th>
                                <th>Vade Tarihi</th>
                                <th>Evrak No</th>
                                <th>Banka</th>
                                <th>Miktar</th>
                                <th>Asıl Kişi</th>
                            </thead>
                            <tbody>
                                @foreach ($pay->paydetail as $list)
                                    <tr>
                                        <td>{{$loop->iteration}} </td>
                                        <td>{{$list->type->name ?? ''}} </td>
                                        <td>{{$list->payloadtype->name ?? ''}} </td>
                                        <td>{{$list->vadetrh}} </td>
                                        <td>{{$list->evrakno}} </td>
                                        <td>{{$list->banka}} </td>
                                        <td>{{$list->miktar}} {{$list->kur->name ?? ''}} </td>
                                        <td>{{$list->asilkisi}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
@endsection

@section('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}
    <script type="text/javascript">
       // $(function(){
       //      var d=new Date("12 25, 2020");
       //      d =d.getTime();
       //      alert(d*3704);
       //      alert(d.getTime() + " milliseconds since 1970/01/01");
       // });
   //      $(document).ready(function() {
   //     $('#ship_id').selectpicker();
   // });
    </script>
@endsection
