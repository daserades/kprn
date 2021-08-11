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
                <div class="card-header">{{ __('Üretim Ürünü Seçme') }}</div> 
                
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <div class="col-md-6">
                                    <td><h3>Kod</h3></td>
                                    <td><h3>İsim</h3></td>
                                    <td><h3>Ürün Türü</h3></td>
                                    <td><h3></h3></td>
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

    
        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            serverSide: true,
        
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
            ajax: '{{ route('uretimjs') }}',
            columns: [
            { data: 'no' },
            { data: 'name' },
            { data: 'urunturu.name' , "defaultContent": ""},
            {data: 'action', orderable: false, searchable: false}
            ],
            

        });

} );
</script>
@endsection
