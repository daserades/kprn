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
	#length{ font-size: 10px;}
</style>
<script type="text/javascript">
	window.print();
	 setTimeout(function () {
    window.history.back();
    }, 2500);
    //window.history.back();
	/*setTimeout( function() {
   history.go(-1);
   }, 100);
   /*function goBack() {
    window.history.back();
}*/
</script>
<body>
	<div>
				@if($uretim->urun->barkod)
				<table  width="300"> 
		<tr>
			<td width="100">
				<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($uretim->urun->barkod, 'EAN13',2.1,45)}}" />
				<br><b class="brkd">{{$uretim->urun->barkod ?? ''}}</b>
			</td>
			<td><center>
				{!! QrCode::size(80)->generate($uretim->no ?? ''); !!}
			</center>
			</td>
		</tr>
		<tr>
			<td colspan="2">	
				<b id="yazi"> @if (Str::length($uretim->urun->tmad) < 100) {{ $uretim->urun->tmad ?? ''}}</b> @else <b id="length">{{ $uretim->urun->tmad ?? ''}}</b>  @endif
			</td>
		</tr>
	</table>
	@else Barcode Girilmemiş Ürün !!!
				@endif
</div></body></html>