@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">{{ __('ÜRÜN SAYIMI') }}</div> 
                <div class="row">
                    <div class="col-md-6 text-md-left" >
                        <a href="{{route('urunbitir',$store->urun_id)}}" onclick="return confirm('Okutulmayan ürünler Silinecek! Emin Misiniz?')" class="btn btn-xs btn-primary">Ürün Sayımı Bitir ve Yeni Depoyu Oluştur...</a>
                    </div>
                    <div class="col-md-6 text-md-right" >
                        <a href="{{route('store.destroy',$store->id)}}" onclick="return confirm('Sayım Bilgilerini Silmek İstediğinize Emin Misiniz?')" class="btn btn-xs btn-danger">Ürün Sayımını Sıfırla ve Yeni Sayıma Başla...</a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="col-md-12 text-md-center">
                    {{$store->urun->no ?? ''}} {{$store->urun->name ?? ''}} 
                </div>

                <form method="POST" action="{{route('store.store')}}">
                    @csrf
                    <input type="hidden" name="urun_id" value="{{$store->urun_id ?? ''}}">
                    <div class="card-header" id="print">{{ __('QR Kodu') }}</div> 
                    <div class="row align-items-center" id="print">
                        <label for="barcode" class="col-md-6 col-form-label text-md-center">{{ __('QR Kod - Ürün Okutma') }}</label>

                        <div class="col-md-6">
                            <input id="barcode" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" autofocus  autocomplete="barcode" placeholder="QR Kodu - Ürünü Buraya Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form> 
                <div class="card-header" align="center">
                    {{ __('Okunan Ürünler') }} 
                </div>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Ürün Kodu</th>
                        <th>Ürün Adı</th>
                        <th>Ürün Sayısı</th>
                    </tr>
                    <tr>
                        <td>
                            {{$sayim->urun->no ?? ''}}
                        </td>
                        <td>
                            {{$sayim->urun->name ?? ''}}
                        </td>
                        <td>
                            {{$sayim->miktar ?? ''}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @endsection
        @section('css')
        <style type="text/css">

        </style>
        @endsection
        @section('js')
        <script type="text/javascript">

        </script>
        @endsection