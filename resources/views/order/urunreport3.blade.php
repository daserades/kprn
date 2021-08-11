@extends('layouts.app')

@section('content')
	<div>
		<div>
			 <div align="center">{{ __('Ürün Hareket Raporu') }} 
			</div>
			<div class="col-md-6">
                        <form action="{{route('urunreportjs3')}}" method="post">
                        	@csrf
                            <div class="input-group">
                                <input type="text" name="kod" class="form-control" placeholder="Kod">
                                <!-- <input type="text" name="urun" class="form-control" placeholder="Ürün"> -->
                                    <select name='urun' id="urun" class="form-control  @error('urun') is-invalid @enderror">
                                            <option value="">Ürün Seçiniz..</option>
                                        @foreach ($urun as $list)
                                            <option value="{{$list->id}}" >{{$list->no}} {{$list->name}}</option>
                                        @endforeach
                                    </select>
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
				<div class="panel body">

					<table id="table" class="table-hover table-striped" border="1">
						<thead>
							<tr>
								<th>Kod</th>
								<th>Ürün</th>
								<th>Tarih</th>
								<th>Miktar</th>
								<th>Tip</th>
							</tr>
						</thead>
						<tbody>
							@isset($uruns)
							@foreach($uruns as $list)
								<tr>
									<td>{{$list->no}} </td>									
									<td>{{$list->name}} </td>									
									<td>{{$list->date}} </td>									
									<td>{{$list->count}} </td>									
									<td>{{$list->type}} </td>									
								</tr>
							@endforeach
							@endisset
						</tbody>
					
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
<style type="text/css">
    	/*th { font-size: 12px; }
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}*/
    	tr:hover td {background:#FF7F50}			
    </style>
@endsection
@section('js')
<script>
</script>
@endsection