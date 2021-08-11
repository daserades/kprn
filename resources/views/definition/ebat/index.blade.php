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
                <div class="card-header">{{ __('Ebat Listesi') }}</div> 
                <div class="row">
                    <div class="col col-md-6"></div>
                    <div class="col-md-4">
                        <form action="{{route('sebat')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2" ><a href="{{route('ebat.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h3>Ad</h3></td>
                                    <td><h3>En</h3></td>
                                    <td><h3>Boy</h3></td>
                                    <td><h3>Yükseklik</h3></td>
                                    <td><h3>Hacim</h3></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ebat as $list)
                            <tr>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->en }}</td>
                                <td>{{ $list->boy }}</td>
                                <td>{{ $list->yukseklik }}</td>
                                <td>{{ $list->hacim }}</td>
                                 <td align="right">
                                <a href="{{route('ebat.edit',$list->id)}}"style="color:black"><i class="far fa-edit fa-2x"></i></a>
                            </td>
                            <td> 
                                <div class="delete-form">
                                    <form action="{{route('ebat.destroy', $list->id)}}" method="POST">
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
                    {{$ebat->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection