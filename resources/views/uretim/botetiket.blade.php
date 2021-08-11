<html><head></head>
<style type="text/css">
	body{
		margin-top:0px;
		margin-left:4px;
	}
	#yazi{
		font-size: 12.5px;
	}
	b.brkd{
		letter-spacing: 9px;
		font-size: 9px;
	}
	b.ss{
		/*letter-spacing: 9px;*/
		font-size: 14px;
	}
	#length{ font-size: 8px;}
</style>

<body><div>
	@if($botarray)		
	@foreach($botarray as $list)
				<table  width="300" height="110"> 
		<tr>
			<td>
				<b class="ss">Bot No= {{$list->id}}  Barcode ={{$list->barcode ?? ''}}</b>
			</td>
		</tr>
		<tr>	
			<td><center>
				{!! QrCode::size(80)->generate($list->barcode ?? ''); !!}
			</center>
			</td>
		</tr>
	</table>

			@foreach($list->botdetail as $liste)
	<table  width="300" height="110"> 
		<tr>
			<td width="100">
				<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($liste->urun->barkod, 'EAN13',2.1,45)}}" />
				<br><b class="brkd">{{$liste->urun->barkod ?? ''}}</b>
			</td>
			<td><center>
				{!! QrCode::size(80)->generate($liste->barcode ?? ''); !!}
			</center>
			</td>
		</tr>
		<tr>
			<td colspan="2">	
				<b id="yazi">@if (Str::length($liste->urun->tmad) < 100) {{ $liste->urun->tmad ?? ''}}</b> @else <b id="length">{{ $liste->urun->tmad ?? ''}}</b>  @endif
			</td>
		</tr>
	</table>
		@endforeach	
		@endforeach	
	@else Barcode Hatalı !!!
				@endif

</div></body></html>

<script type="text/javascript">
	window.print();
   window.history.back();
	/*setTimeout( function() {
   history.go(-1);
   }, 100);
   /*function goBack() {
    window.history.back();
}*/
</script>
