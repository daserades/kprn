@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
				<div class="card-header">{{ __('Proforma') }}</div>

				@if ($message = Session::get('success'))	
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif

                <table class="table-striped" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>Ürün</th>
                                <th>Miktar</th>
                                <th>Fiyat</th>
                                <th>Tutar</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody> @php $mtot=0; $mtoplam=0; $fiyat=0; $tfiyat=0; $ttot=0; $ttoplam=0; @endphp
                        @isset($order)
                        @foreach($order as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->tmad ?? ''}}</td>
                            <td align="right">{{ $mtot= $list->miktar ?? 0}} ad.</td>
                            <td align="right">{{ number_format($list->fiyat,3) ?? 0 }}</td>
                            <td align="right">{{ number_format($list->tutar,3) ?? 0 }}</td>
                        </tr> @php $mtoplam += (float)$mtot;  $ttoplam += (float)$list->tutar; $tfiyat += (float)$list->fiyat; @endphp
                        @endforeach @endisset 
                       	<tr>
                       		<td colspan="2">Toplam</td>
                       		<td align="right">{{$mtoplam ?? ''}}ad </td>
                            <td></td>
                       		<td align="right">{{number_format($ttoplam,3) ?? ''}} </td>
                       	</tr>
            </tbody></table>
			</div>
		</div>
	</div>
</div>
@endsection
