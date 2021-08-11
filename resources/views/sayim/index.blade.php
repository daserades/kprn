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
                <div class="card-header">{{ __('SAYIM') }}</div> 
                <div class="row">
                    <div class="col-md-6 text-md-left" >
                        <a href="{{route('sayim.create')}}" class="btn btn-xs btn-primary">Sayım İçin Tıklayınız....</a>
                    </div>
                    <div class="col-md-6 text-md-right" >
                        <a href="{{route('sayim.create')}}" class="btn btn-xs btn-danger">Sayımı Sıfırlama....</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                 <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Ürün Kodu</th>
                                        <th>Ürün Adı</th>
                                        <th>Ürün Sayısı</th>
                                    </tr>
                                    @foreach($sayim as $list)
                                    <tr>
                                        <td>
                                            {{$list->urun->no}}
                                        </td>
                                        <td>
                                            {{$list->urun->name}}
                                        </td>
                                        <td>
                                            {{$list->miktar}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

