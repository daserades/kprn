@extends('layouts.app')

@section('content')
<div >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Depo Stok') }}</div> 
                <div class="row-center">
            </div>
            <div class="card-body">
                <table id="table" class="table table-hover" >
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Kod</td>
                                <td>Ürün İsmi</td>
                                <td>Ürün Türü</td>
                                <td>S.U.S. Miktar</td>
                                <td>Depodaki Miktar</td>
                                <td></td>
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
        th { font-size: 12px; }
        td {
             font-size: 12px; 
            font-weight: bold;
        }
        #sel{
             width:50px;   
            }
        /*tr:hover td {background:#FF7F50}
        th.asd input[type="text"]
            {
            font-weight: bold;
                font-size:16px;
                width:120px;
            }
            */
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
            // colReorder: true,
             ajax: '{{ route('store.create') }}',
            columns: [
            { data: 'no' ,"defaultContent": "" },
            { data: 'name' ,"defaultContent": "" },
            { data: 'tur' ,"defaultContent": "" },
            { data: 'miktar' ,"defaultContent": "0" },
            { data: 'count' ,"defaultContent": "0" },
            { data: 'action' , orderable: false, searchable: false}
            ], initComplete: function () {
            this.api().columns([0,1,2]).every( function () {
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

            tkoli = api
                .column( 3, { search: 'applied' } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );        
            tmik = api
                .column( 4, { search: 'applied' } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );    

                // bakiye = api
                // .column( 13, { page: 'current'} )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 );    
                // var display = $.fn.dataTable.render.number( '.', ',', 3 ).display;
                // var formattedNumber = display( tmik );
            // koli = api
            //     .column( 3, { page: 'current'} )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );
            //     miktar = api
            //     .column( 4, { page: 'current'} )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );
            
            $( api.column( 3 ).footer() ).html(
                // display( koli )+
                'T='+ tkoli 
            );
            $( api.column( 4 ).footer() ).html(
                // miktar +
                'T='+ tmik 
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

    });
   
</script>
@endsection

