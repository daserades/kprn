@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Firma Cari Raporu') }}</div>

                @if ($message = Session::get('success'))    
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                    <table class="table-striped"> 
                    <tr>
                    <td colspan="4">
                    <div class="card-body text-md-center"><img src="{{ Storage::url('logo.jpg') }}" alt="Smiley face" height="80" width="300"></div>
                </td>
                </tr><tr>
                    <td>
                        <label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Ünvan:  ') }}{{ $firma->unvan ?? ''}}</label> 
                    </td>
                    <td> 
                        <label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Vergi Dairesi:  ') }}{{ $firma->vergidairesi ?? ''}}</label> 
                    </td>
                    <td> 
                        <label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Vergi No:  ') }}{{ $firma->verginumarasi ?? ''}}</label> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('Telefon :  ') }}{{ $firma->telefon1 ?? ''}}</label> 
                    </td>
                    <td>
                        <label for="firma_id" class="col-md-12 col-form-label text-md-left">{{ __('D.Cinsi :  ') }}{{ $firma->kur->name  ?? ''}}</label> 
                    </td>
                    <td>
                        
                    </td>
                </tr>                   
                    </table>
                    {{-- <div class="card-header">{{ __('Cari Detayı') }}</div> --}}

                <table class="table-striped" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>Tarih</th>
                                <th>Vade Tarih</th>
                                <th>İşlem Türü</th>
                                <th>Açıklama</th>
                                <th>Borç</th>
                                <th>Alacak</th>
                                <th>Bakiye</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($firma->cari) > 0)
                        @foreach($firma->cari as $list)
                        <tr>
                            <td>{{$loop->iteration}} </td>
                            <td>{{$list->trh ?? ''}} </td>
                            <td>{{$list->vadetrh ?? ''}} </td>
                            <td> @if (isset($list->pay->no)) Ödeme --- {{$list->pay->no }} @else
                             @isset($list->ship->id) <a href="{{route('fis',$list->ship->id) ?? ''}}" target="_blank" style="color:black" title="FİŞ GÖSTER"> @endisset
                             Satış --- {{$list->ship->irsaliyeno ?? ''}} @endif</a></td>
                            <td>{{$list->pay->aciklama ?? ''}} </td>
                            <td align="right">{{number_format($list->tutar,2) ?? ''}} </td>
                            <td align="right">{{number_format($list->alinantutar,2) ?? ''}} </td>
                            <td align="right">{{number_format($list->bakiye,2) ?? ''}} </td>
                        </tr>
                        @endforeach 
                        <tr>
                            <td colspan="5">Toplam </td>
                            <td align="right">{{number_format($firma->cari->sum('tutar'),2) ?? ''}} </td>
                            <td align="right">{{number_format($firma->cari->sum('alinantutar'),2) ?? ''}} </td>
                            <td align="right">{{number_format($list->bakiye,2) ?? ''}} </td>
                        </tr>
                        @endif
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
