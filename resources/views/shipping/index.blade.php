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
                <div class="card-header">{{ __('Sevkiyat Listesi') }}</div> 
            <div class="card-body">
                <table id="table" class="table">
                    <thead>
                        <tr>
                                <th>Firma Adı</th>
                                <th>Form No</th>
                                <th>Tarih</th>
                                <th>Sevk Tarih</th>
                                <th>Sipariş Durumu</th>
                                <th>Kalan Koli</th>
                                <th>Açıklama</th>
                                <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                     <tfoot> 
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                        </tfoot>
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
<style type="text/css">
        tr:hover td {background:#FF7F50}
</style>
@endsection
@section('js')
<script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
            $('#table tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" size="4" placeholder="Search '+title+'" />' );
            } );


        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            serverSide: true,
        
            ajax: '{{ route('shippingjs') }}',
            columns: [
            { data: 'firma' ,"defaultContent": "" },
            { data: 'no' ,"defaultContent": ""},
            { data: 'created_at' ,"defaultContent": ""},
            { data: 'sevktrh' ,"defaultContent": ""},
            { data: 'orderstatus' ,"defaultContent": ""},
            { data: 'koli' ,"defaultContent": "" ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
            { data: 'aciklama' ,"defaultContent": ""},
            {data: 'action', orderable: false, searchable: false}
            ],
        });

        table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );  
</script>
@endsection

