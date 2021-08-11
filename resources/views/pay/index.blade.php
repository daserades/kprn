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
                    <div class="card-header">{{ __('Ödeme(Cari) Listesi') }}</div>
                        <div class="col-md-2" ><a href="{{route('pay.create')}}" class="btn btn-xs btn-primary">Yeni</a> </div>
                            <div class="card-body">
                            <table id="table" class="table">
                            <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h6>Firma Adı</h6></td>
                                    <td><h6>Form No</h6></td>
                                    <td><h6>Tarih</h6></td>
                                    <td><h6>Açıklama</h6></td>
                                    <td><h6></h6></td>
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
        $('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );


        $(function() {
            var table= $('#table').DataTable({
                order:[],
                processing: true,
                serverSide: true,

                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
                },
                ajax: '{{ route('payjs') }}',
                columns: [
                    { data: 'firma.name' ,"defaultContent": "" },
                    { data: 'no' ,"defaultContent": ""},
                    { data: 'trh' },
                    { data: 'aciklama' },
                    {data: 'action', orderable: false, searchable: false}
                ],
            });
        } );
    </script>
@endsection

