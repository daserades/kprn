<html><head></head><body><div>
	@foreach($array as $list)
	<table  width="300"> 
		<tr>
			<td width="100">
				<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($sql->barkod, 'EAN13',2.1,45)}}" />
				<br><b class="brkd">{{$sql->barkod ?? ''}}</b>
			</td>
			<td><center>
				{!! QrCode::size(80)->generate($list->no ?? ''); !!}
			</center>
			</td>
		</tr>
		<tr>
			<td colspan="2">	
				<b id="yazi"> @if (Str::length($sql->tmad) < 100) {{ $sql->tmad ?? ''}}</b> @else <b id="length">{{ $sql->tmad ?? ''}}</b>  @endif
			</td>
		</tr>
	</table>
		@endforeach	

</div></body></html>
<style type="text/css">
	body{
		margin-top:0px;
		margin-left:4px;
	}
	#yazi{
		font-size: 12px;
	}
	b.brkd{
		letter-spacing: 9px;
		font-size: 9px;
	}
	#length{ font-size: 8px;}
</style>
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

