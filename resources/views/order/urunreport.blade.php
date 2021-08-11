@extends('layouts.app')

@section('content')
	<div>
		<div>
			 <div align="center">{{ __('Ürün Bazında Satış Raporu') }} 
			 	@isset($gtrh) -->({{$gtrh}}  @endisset @isset($ctrh) ---{{$ctrh}})  @endisset
			</div>
			<div class="col-md-12">
                        <form action="{{route('urunreportjs')}}" method="post">
                        	@csrf
                            <div class="input-group">
                                <input type="text" name="date" class="form-control" placeholder="Tarih Aralığı" value="@isset($gtrh) {{$gtrh}} > {{$ctrh}}  @endisset">
                                <input type="text" name="kod" class="form-control" placeholder="Kod">
                                <input type="text" name="urun" class="form-control" placeholder="Ürün">
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
								<th>Adet</th>
								<th>Tutar</th>
							</tr>
						</thead>
						<tbody>
							@isset($urun)
							@foreach($urun as $list)
								<tr>
									<td>{{$list->no ?? ''}} </td>
									<td>{{$list->name ?? ''}} </td>
									<td>{{$list->mik ?? ''}} </td>
									<td></td>
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
<link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}} ">
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
<script type="text/javascript" src="{{asset('js/moment.min.js')}} "></script>
<script type="text/javascript" src="{{asset('js/daterangepicker.js')}} "></script>
<script>
$('input[name="date"]').dateRangePicker();
</script>
@endsection