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
                <div class="card-header">{{ __('Yetkili Listesi') }}</div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{route('syetkili')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                <div class="col-md-2" ><a href="{{route('yetkili.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td><h5>Ad</h5></td>
                                <td><h5>Soyad</h5></td>
                                <td><h5>Firma</h5></td>
                                <td><h5>Görev Listesi</h5></td>
                                <td><h5>Telefon</h5></td>
                                <td><h5>Telefon(GSM)</h5></td>
                                <td><h5>Email</h5></td>
                                <td><h5>Açıklama</h5></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yetkili as $list)
                        <tr>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->surname }}</td>
                            <td>@isset($list->firma->name){{ $list->firma->name }} @endisset</td>
                            <td>@isset($list->gorevlistesi->name){{ $list->gorevlistesi->name }}@endisset</td>
                            <td>{{ $list->tel }}</td>
                            <td>{{ $list->ceptel }}</td>
                            <td>{{ $list->email }}</td>
                            <td>{{ $list->aciklama }}</td>
                             <td align="right">
                                <a href="{{route('yetkili.edit',$list->id)}}"style="color:black"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('yetkili.destroy', $list->id)}}" method="POST">
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
                {{$yetkili->links()}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
