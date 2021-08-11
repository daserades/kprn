<html><head></head>
<style type="text/css">
	body{
		margin-top:0px;
		margin-left:4px;
	}
	#yazi{
		font-size: 9px;
	}
	b.brkd{
		/*letter-spacing: 9px;*/
		font-size: 12px;
	}
	#length{ font-size: 8px;}
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
				@if($bot->barcode)		
				<table  width="300"> 
		<tr>
			<td>
				<b class="brkd">Bot No= {{$bot->id}}  Barcode ={{$bot->barcode ?? ''}}</b>
			</td>
		</tr>
		<tr>	
			<td><center>
				{!! QrCode::size(100)->generate($bot->barcode ?? ''); !!}
			</center>
			</td>
		</tr>
	</table>
	@else Barcode Girilmemiş !!!
				@endif
</div></body></html>