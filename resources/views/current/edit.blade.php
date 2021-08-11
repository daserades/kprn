@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                	{{$firma->name ?? ''}} --- {{ __('Firma Cari') }}
                </div>
            <div class="card-body">
            	<table class="table">
            		<thead>
            			<th></th>
            			<th>Tip</th>
            			<th>Tip No</th>
            			<th>Sipariş No</th>
            			<!-- <th>Sevk Tarihi</th> -->
            			<th>Sevk Tutarı</th>
            			<th>Ödeme Tutarı</th>
            			<th>Döviz Cinsi</th>
            			<th>Tarih</th>
            			<th>Cari Durumu</th>
            			<th></th>
            		</thead>  
            		<tbody>
            			@foreach ($current as $list)
            				<tr>
            					<input type="hidden" id="" name="value" class="" value="">
            					<td>@if($list->durum_id == 1) <input id="option_{{$list->id}}" type="checkbox" class="custom-control-checkbox" name="option_{{$list->option}}"> @endif</td>
            					<td>@if($list->option == 1) İrsaliye @elseif ($list->option  == 2) Ödeme @endif</td>
            					<td>@if($list->option == 1) {{$list->ship->irsaliyeno ?? ''}} @elseif ($list->option  == 2) {{$list->pay->no ?? ''}} @endif</td>
            					<td>{{$list->order->no ?? ''}} </td>
            					<!-- <td>@isset($list->ship->created_at){{ date('d-m-Y',strtotime($list->ship->created_at))}} @endisset</td> -->
            					<td>{{ number_format($list->debt,2) ?? ''}} </td>
            					<td>{{number_format($list->paid,2) ?? ''}} </td>
            					<td>{{$list->kur->name ?? ''}} </td>
            					<td>{{ date('d-m-Y',strtotime($list->vadetrh)) ?? ''}} </td>
            					<td>{{$list->durum->surname ?? ''}} </td>
            					<td>
				                	@if($list->durum_id == 1)<a href="#" id="{{$list->id}}" name="kapat" style="color:black" title="Kapat"><i class="far fa-closed-captioning fa-2x"></i></a>@endif
			                		<a href="" id="{{$list->id}}" name="fifo" style="color:black" title="Fifo Kapat"><i class="fas fa-globe fa-2x"></i></a>
				                	@if($list->durum_id ==2)<a href="" id="{{$list->id}}" name="gerial" style="color:black" title="Geri Al"><i class="fas fa-reply-all fa-2x"></i></a>
				                	@endif
            					</td>
            				</tr>
            			@endforeach
            		</tbody>
            	</table>
            </div>
           </div>
        </div>
    </div>    
</div>
@endsection

@section('js')
<script type="text/javascript">
	// $("#checkAll").click(function(){
 //    	$('input:checkbox').not(this).prop('checked', this.checked);
	// });
	$("input[type=checkbox]").hide();

	$("a[name=kapat]").click(function(){
		$("input[name=value]").val("");
		id=$(this).attr('id');
		options=$('#option_'+id).attr("name");options =options.split("_");option = options[1];
		if(option==1){option=2; var a=1;}
		else if(option==2) {option=1; var a=2;}
		$("input[name=option_"+option+"]").toggle();
		$("input[name=option_"+a+"]").hide();
		$("input[name=value]").val(id);
	});

	$("input[type=checkbox]").change(function(){
		$(this).toggle("highlight");
		checkboxs=$(this).attr('id');checkboxs =checkboxs.split("_");checkbox_id = checkboxs[1];
		id=$("input[name=value]").val();
		options=$('#option_'+id).attr("name");options =options.split("_");option = options[1];
		$.ajaxSetup({
	     headers: {
	         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	     });
	    sayfa = '{{ route('current.store') }}';
	    $.post(sayfa, {id: id, checkbox_id: checkbox_id,option: option }, function(data) {
	        $("#"+checkbox_id).toggle( "highlight" );
	        // alert(data);
	        location.reload();
	    });
	});

    $("a[name=gerial]").click(function(){
		$(this).toggle("highlight");
    	id=$(this).attr("id");
    	$.ajaxSetup({
	     headers: {
	         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	     });
	    sayfa = '{{ route('back') }}';
	    $.post(sayfa, {id: id}, function(data) {
	        $("#"+id).toggle( "highlight" );
	        // console.log(data);
	        location.reload();
	    });
    });
</script>

@endsection