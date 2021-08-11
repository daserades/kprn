@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" align="center">
                    {{ __('Bot Detayı') }}
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table  class="table-sm">
                    <tr>
                        <td>
                            Bot Barcode   : {{$bot->barcode  ?? ''}}
                        </td>
                        <td>Bot İçi Adet    :{{ $bot->type ?? ''}}
                        </td>
                    </tr>
                </table> 
                <form method="POST" action="{{route('botdetail.store')}}">
                    @csrf
                    <div class="card-header" id="print">{{ __('QR Kodu Okutma') }}</div> 
                    <div class="row align-items-center" id="print">
                        <input id="bot_id" name="bot_id" type="hidden" class="form-control" value="{{ $bot->id }}">
                        <label for="barcode" class="col-md-2 col-form-label text-md-center">{{ __('QR Kod - Ürün Okutma') }}</label>

                        <div class="col-md-10">
                            <input id="barcode" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"  autofocus  autocomplete="barcode" placeholder="QR Kodu - Ürünü Buraya Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form> 
                <div class="card-header">{{ __('Bot İçi Ürün Bilgileri') }}</div>

                <table class="table-sm table-striped table-hover" border="1">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Kod</td>
                                <td>Ürün</td>
                                <td>Miktar</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($bot->botdetail)
                        @foreach($bot->botdetail as $list)
                            <tr>
                                <td></td>
                                <td>{{$list->urun->no}} </td>
                                <td>{{$list->urun->name}} </td>
                                <td>{{$list->count}} </td>
                            </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                <div>
                <form method="POST" action="{{route('botdetaildestroy')}}">
                    @csrf
                    <div class="row align-items-center" id="print">
                        <input id="bot_id" name="bot_id" type="hidden" class="form-control" value="{{ $bot->id }}">
                        <label for="barcode" class="col-md-3 col-form-label text-md-center">{{ __('Silinecek QR Kod') }}</label>
                        <div class="col-md-9">
                            <input id="barcode" type="number" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" @if (Session::has('destroyqrfocus')) autofocus @endif  autocomplete="barcode"  placeholder="Silinecek QR Kodu Buraya Okutunuz..." >
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

@endsection
@section('css')
<style type="text/css">
   @media print {
      #print,#orderstatuses_id {
        display :  none;
    }

}
</style>
@endsection
@section('js')
<script type="text/javascript">
    $("#print").click(function(){

        window.print();
       /* setTimeout( function() {
           history.go(-1);
       }, 100);
       */
    });
    $("#orderstatuses_id").change(function(){
        $(this).toggle('highlight');
        val = $(this).val();
        id = $("#order_id").val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
        sayfa = '{{ route('orderstatus') }}';
        $.post(sayfa, {val:val, id:id}, function(data) {
            $('select[name=orderstatuses_id').toggle( "highlight" );
            location.reload();
        });
    });

    $("input[name=koliadet").change(function(){
        $('input[name=koliadet').toggle( "highlight" );
        //val = $(this).val();
        id = $("#order_id").val();
        koliadet = $("#koliadet").val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
        sayfa = '{{ route('koli') }}';
        $.post(sayfa, { id:id,koliadet:koliadet}, function(data) {
            $('input[name=koliadet').toggle( "highlight" );
        });
    });

  /*  $("input[name=oldbarcode").change(function(){
        $(this).toggle( "highlight" );
        order_id = $(this).attr('id');
        barcode= $(this).val();
        barcode= $().val();
        $.ajaxSetup({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
         });
        sayfa = '{{ route('oldorder') }}';
        $.post(sayfa, {order_id:order_id,barcode:barcode}, function(data) {
            $('input[name=koliadet').toggle( "highlight" );
        });
    });
*/
</script>
@endsection