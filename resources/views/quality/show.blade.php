@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Sevk Detay') }}</div>
                                <table border="1" class="table">
                    <tr>
                        <td>
                            Firma  :{{$quality->firma->name?? ''}}
                        </td>
                        <td>
                            Para Birimi   : {{$quality->kur->name ?? ''?? ''}}
                        </td>
                        <td>
                            Baz Alınan Kur   : {{$quality->bazkur ?? ''?? ''}}
                        </td>
                        <td>
                            Vade   : {{$quality->vade ?? ''?? ''}}
                        </td>
                        <td>İskonta    :{{ $quality->iskonta ?? ''}}

                        </td>
                        <td>Sevk Tarihi    :{{ $quality->sevktrh ?? ''}}

                        </td>
                        <td> Açıklama   :  {{ $quality->explanation ?? ''}}
                        </td>
                        
                    </tr>
                </table> 
               
            
                      <table class="table table-sm table-striped" >
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>Ürün</th>
                                <th>Ürün Tipi</th>
                                <th>Miktar</th>
                                <th>Birim</th>
                                <th>Fiyat</th>
                                <th>Tutar</th>
                                <th>Açıklama</th>
                                <th colspan="2"></th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($quality->qualitydetail)
                        @foreach($quality->qualitydetail as $list)
                        <tr>
                            <td>{{ $loop->iteration ?? ''}}</td>
                            <td>{{ $list->urun->no ?? ''}}{{ $list->urun->name ?? ''}}</td>
                            <td>{{ $list->qualitytype->name ?? ''}}</td>
                            <td>{{ $list->amount ?? ''}}</td>
                            <td>{{ $list->unit->name ?? ''}}</td>
                            <td>{{ $list->price ?? ''}}</td>
                            <td>{{ $list->sum ?? ''}}</td>
                            <td>{{ $list->explanation ?? ''}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Toplam</td>
                            <td>{{$quality->qualitydetail->sum('amount')?? ''}} </td>
                            <td></td>
                            <td>{{$quality->qualitydetail->sum('price')?? ''}} </td>
                            <td>{{$quality->qualitydetail->sum('sum')?? ''}} </td>
                            <td></td>
                        </tr>
                         @endisset
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>

@endsection
