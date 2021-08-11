@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">{{ __('Sevk Detay') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table border="1" class="table">
                    <tr>
                        <td>
                            Firma  :{{$quality->firma->name}}
                        </td>
                        <td>
                            Vade   : {{$quality->vade ?? ''}}
                        </td>
                        <td>İskonta    :{{ $quality->iskonta }}

                        </td>
                        <td>Sevk Tarihi    :{{ $quality->sevktrh }}

                        </td>
                        <td> Açıklama   :  {{ $quality->explanation }}
                        </td>
                        
                    </tr>
                </table> 
                <div class="card-header">{{ __('Ürün Girişi') }}  </div> 
                
                    <form method="POST" action="{{route('qualitydetailstore')}}">
                        @csrf
                        

                        <div class="form-group row">
                            
                        <input id="quality_id" name="quality_id" type="hidden" class="form-control" value="{{ $quality->id }}">
                            <div class="col-md-6">
                                <label for="urun_id" class="col-form-label text-md-right">{{ __('Ürün') }}</label><br>

                                    <select name='urun_id' id="urun_id" class="form-control  @error('urun_id') is-invalid @enderror" >
                                        <option value="">Seçiniz..</option>
                                    @foreach ($urun as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('urun_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                    @enderror
                                </div>
                            
                            
                                <div class="col-md-6">
                                <label for="qualitytype_id" class="col-form-label text-md-right">{{ __('Ürün Tipi') }}</label>

                                    <select name='qualitytype_id' id="qualitytype_id" class="form-control  @error('qualitytype_id') is-invalid @enderror" >
                                        <option value="">Seçiniz..</option>
                                    @foreach ($qualitytype as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('qualitytype_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                    @enderror
                                </div>
                            
                            
                            <div class="col-md-6">
                            <label for="amount" class="col-form-label text-md-center">{{ __('Miktar') }}</label>

                                <input id="amount" type="number" step="0.001" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}"  autocomplete="amount" autofocus >

                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                                
                            
                                <div class="col-md-6">
                               <label for="unit_id" class="col-form-label text-md-right">{{ __('Birim') }}</label>

                                    <select name='unit_id' id="unit_id" class="form-control  @error('unit_id') is-invalid @enderror" >
                                        <option value="">Seçiniz..</option>
                                    @foreach ($unit as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                    @enderror
                                </div>
                            
                                
                        

                            <div class="col-md-6">
                            <label for="price" class="col-form-label text-md-center">{{ __('Tutar') }}</label>

                                <input id="price" type="number" step="0.001" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus >

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                            <label for="explanation" class="col-form-label text-md-right">{{ __('Açıklama') }}</label>
                               <textarea id="explanation" type="text" class="form-control"  name="explanation"  autocomplete="explanation" autofocus>
                               </textarea>
                           </div>
                       </div> 
                                
                            <div >
                                <button type="submit" class="btn btn-success">
                                    {{ __('Ekle') }}
                                </button>
                            </div>
                            </td>
                        </tr>
                        </div>
                    </form>
            
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
                                <th>Sum</th>
                                <th>Açıklama</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($quality->qualitydetail)
                        @foreach($quality->qualitydetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->urun->no ?? ''}}{{ $list->urun->name ?? ''}}</td>
                            <td>{{ $list->qualitytype->name ?? ''}}</td>
                            <td>{{ $list->amount ?? ''}}</td>
                            <td>{{ $list->unit->name ?? ''}}</td>
                            <td>{{ $list->price }}</td>
                            <td>{{ $list->sum }}</td>
                            <td>{{ $list->explanation }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">Toplam</td>
                            <td>{{$quality->qualitydetail->sum('price')}} </td>
                            <td>{{$quality->qualitydetail->sum('sum')}} </td>
                            <td></td>
                        </tr>
                         @endisset
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
$( function() {
    $('#urun_id').select2({ width: '480px' });
});
</script>
@endsection