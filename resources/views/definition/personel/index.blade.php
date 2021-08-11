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
                <div class="card-header">{{ __('Personel Listesi') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{route('spersonel')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                <div class="col-md-2" ><a href="{{route('personel.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                </div>

                    <div>
                        <select name='list' class="form-control" onchange="location = this.value;">
                            <option value="">Seçiniz..</option>
                            @isset($durum)
                            @foreach ($durum as $list)
                                <option name="list" id="list" value="{{route('listpersonel',$list->id)}}">{{$list->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5>Ad</h5></td>
                                <td><h5>Soyad</h5></td>
                                <td><h5>Telefon(GSM)</h5></td>
                                <td><h5>Departman</h5></td>
                                <td><h5>Görev Listesi</h5></td>
                                <td><h5>Giriş Tarihi</h5></td>
                                <td><h5>User</h5></td>
                                <td><h5>Adres</h5></td>
                                <td><h5></h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personel as $list)
                        <tr>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->surname }}</td>
                            <td>{{ $list->tel }}</td>
                            <td>@isset($list->departman->name){{ $list->departman->name }} @endisset</td>
                            <td>@isset($list->gorevlistesi->name){{ $list->gorevlistesi->name }}@endisset</td>
                            <td>@if ($list->gtrh){{ date('d-m-Y', strtotime($list->gtrh)) }}
                                @endif
                            </td>
                            <td>{{ $list->user->name }}</td>
                            <td>{{ $list->adres }}</td>
                            <td align="right">
                                <a href="{{route('personel.edit',$list->id)}}"style="color:black"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('personel.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                         <button class="btn btn-danger" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$personel->links()}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
