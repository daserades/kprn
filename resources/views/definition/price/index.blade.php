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
                <div class="card-header">{{ __('Fiyatlar') }}</div> 
                <div class="row">
                    <div class="col col-md-6"></div>
                    <div class="col-md-4">
                        <form action="{{route('sprice')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h3>Eski Fiyat</h3></td>
                                    <td><h3>Yeni Fiyat</h3></td>
                                    <td><h3>Kod</h3></td>
                                    <td><h3>İsim</h3></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urun as $list)
                            <tr>

                                <td>{{$list->price->price ?? ''}}</td>
                                 <td align="right">
                                <input id="{{$list->id}}" name="price" class="asd" value="{{ $list->price->price ?? '' }}">
                            </td>
                                <td>{{ $list->no }}</td>
                                <td>{{ $list->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$urun->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(".asd").change(function() {
            $(this).toggle( "highlight" );
            yer = $(this).attr('id');
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('price.store') }}';
            deger = $(this).val();
            $.post(sayfa, {urun_id: yer, deger: deger }, function(data) {
                $("#"+yer).toggle( "highlight" );
            });
            
        });


</script>
@endsection