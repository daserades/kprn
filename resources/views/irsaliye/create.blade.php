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
				<div class="card-header">{{ __('Fiş-İrsaliye Ekranı') }}</div>
				<div class="col-md-6">
                        <form action="{{route('sirsaliye')}}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
				<table class="table-striped table-hover" border="1">
					<thead>
						<tr>
							<div class="col-md-6">
								<th></th>
								<th>Firma</th>
								<th>Nakliye Firması</th>
								<th>Tarih</th>
								<th>Koli Adedi</th>
								<th>İRSALİYE NO</th>
								<th>FİŞ-İRSALİYE</th>
							</div>
						</tr>
					</thead>
					<tbody> 
						@foreach($ship as $list)
						<tr>
							<td> {{$loop->iteration}} </td>
							<td> {{$list->firma->name ?? ''}} </td>	
							<td> {{$list->firma->parent->name ?? ''}} </td>
							<td> {{date('d-m-Y', strtotime($list->created_at)) ?? ''}} </td>
							<td> @if(isset($list->koliadet)) {{$list->koliadet ?? ''}} @else {{$list->okoli ?? ''}} @endif </td>
							<td> <input type="text" id="{{$list->id ?? ''}}" name="no" value="{{$list->irsaliyeno ?? ''}}">  </td>
							<td align="center"> 
                             <a href="{{route('fis',$list->id)}}" target="_blank" style="color:black" title="FİŞ GÖSTER"><i class="far fa-file fa-2x"></i></a>
                             <a href="{{route('shipfis',$list->id)}}" target="_blank" style="color:black" title="FİŞ DETAY GÖSTER"><i class="fas fa-file-alt fa-2x"></i></a>
                             <a href="{{route('shipirsaliye',$list->id)}}" target="_blank" style="color:black" title="İRSALİYE GÖSTER"><i class="far fa-file-alt fa-2x"></i></a>
							 <a href="#"style="color:black" title="İRSALİYE AKTAR"><i class="fas fa-file-import fa-2x"></i></a>
							 </td>
						</tr>
						@endforeach
					</tbody>
				</table>
                    {{$ship->links()}}
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>

    $("input[name=no]").change(function(){
        $(this).toggle( "highlight" );
    	no=$(this).val();
    	id=$(this).attr('id');
    	$.ajaxSetup({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
        sayfa = '{{ route('irsaliyeno') }}';
        $.post(sayfa, {no:no,id:id}, function(data) {
            $('#'+id).toggle( "highlight" );
        });
    });
    </script>
@endsection
