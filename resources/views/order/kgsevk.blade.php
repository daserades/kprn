@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('KG Sevk Listesi') }}</div> 
                <div class="row">
                    <div class="col col-md-6"></div>
                    <div class="col-md-2" ><a href="{{route('kgsevkcreate')}}" class="btn btn-xs btn-primary">Yeni</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                               <div clss="col-md-6">
                                    <td><h3>Firma</h3></td>
                                    <td><h3>Kod</h3></td>
                                    <td><h3>Ürün</h3></td>
                                    <td><h3>Miktar</h3></td>
                                    <td><h3>Birim</h3></td>
                                    <td><h3>Fiyat</h3></td>
                                    <td></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kgsevk as $list)
                            <tr>
                                <td>{{ $list->firma->name ?? ''}}</td>
                                <td>{{ $list->urun->no ?? ''}}</td>
                                <td>{{ $list->urun->name ?? ''}}</td>
                                <td>{{ $list->miktar ?? ''}}</td>
                                <td>{{ $list->unit->name ?? ''}}</td>
                                <td>{{ $list->fiyat ?? ''}}</td>
                                <td><a href="{{route('kgsevkshow',$list->id)}}" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$kgsevk->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
