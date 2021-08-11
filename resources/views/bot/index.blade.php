@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Bot Listesi') }}</div> 
                <div class="row-center">
                <div class="col-md-6" ><a href="{{route('bot.create')}}" class="btn btn-xs btn-primary">Yeni</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Bot Barcode</td>
                                <td>Bot İçi Adet</td>
                                <td></td>
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

@section('css')
<link href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">  
<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $(function() {

    $('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );


        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            serverSide: true,
        
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
            dom: 'Blfrtip',
            ajax: '{{ route('botjs') }}',
            columns: [
            { data: 'barcode' ,"defaultContent": ""},
            { data: 'type' ,"defaultContent": ""},
            {data: 'action', orderable: false, searchable: false}
            ],
            

        });

} );










    
</script>
@endsection

