@extends('layouts.app')

@section('content')
<div>
    <div>
        <div>
            <div class="card">
                <div class="card-header">{{ __('Sipariş Raporu') }}</div> 
            </div>
            <div class="card-body">
                <table id="table" class="table table-hover table-xs">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Firma Adı</td>
                                <td>Sip.No</td>
                                <td>Kod</td>
                                <td>Ürün Adı</td>
                                <td>Sip.Durum</td>
                                <!-- <td>Koli İçi A.</td> -->
                                <td>Kalan Koli</td>
                                <!-- <td>Sipariş Miktar</td> -->
                                <!-- <td>Giden Miktar</td> -->
                                <td>Kalan Miktar</td>
                                <!-- <td>Fiyat</td> -->
                                <td>Tutar</td>
                            </div>
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
    <link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
    <style type="text/css">
        th { font-size: 12px; }
        td {
             font-size: 12px; 
            font-weight: bold;
        }
        #sel{
             width:40px;   
            }
        tr:hover td {background:#FF7F50}
        /*th.asd input[type="text"]
            {
            font-weight: bold;
                font-size:16px;
                width:120px;
            }*/
            
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
            // serverSide: true,
        
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
            dom: 'Blfrtip',
          
            ajax: '{{ route('reportjs') }}',
            columns: [
            { data: 'firma' ,"defaultContent": "" },
            // { data: 'orderno' ,"defaultContent": ""},
            {data: null , name:'orderno' ,render: function ( data, type, row) {
                //console.log(row);
                if (row.orderno != null) return '<a href="{{url('shipping/shipping/')}}/'+data.order_id+'" target="_blank">'+row.orderno+'</a>';
            } },
            { data: 'no' ,"defaultContent": ""},
            { data: 'urun' ,"defaultContent": ""},
            { data: 'durum' ,"defaultContent": ""},
            // { data: 'koliiciadet' ,"defaultContent": ""},
            { data: 'koli' ,"defaultContent": "" , render: $.fn.dataTable.render.number( '.', ',', 2)},
            // { data: 'sipmik' ,"defaultContent": ""},
            // { data: 'giden' ,"defaultContent": ""},
            { data: 'kalansipmik' ,"defaultContent": ""},
            // { data: 'fiyat' ,"defaultContent": ""},
            { data: 'tutar' ,"defaultContent": "", render: $.fn.dataTable.render.number( '.', ',', 2)},
            ], initComplete: function () {
            this.api().columns([0,2,3,4]).every( function () {
                var column = this;
                var select = $('<select id="sel"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }   
        ,footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            page = api
                .column( 7, { search: 'applied' } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            tmik = api
                .column( 6, { search: 'applied' } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );    
            tkoli = api
                .column( 5, { search: 'applied' } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );        

                // bakiye = api
                // .column( 15, { page: 'current'} )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 );    
                var display = $.fn.dataTable.render.number( '.', ',', 2 ).display;
                // var formattedNumber = display( tmik );
            koli = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                miktar = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                tutar = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            $( api.column( 5 ).footer() ).html(
                // display( koli )+
                'T='+ display( tkoli ) 
            );
            $( api.column( 6 ).footer() ).html(
                // miktar +
                'T='+ display( tmik ) 
            );
            $( api.column( 7 ).footer() ).html(
                // 'Sayfa T.'+display( tutar) +
                'T='+ display( page ) 
            );

        }

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

