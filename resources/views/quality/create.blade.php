@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('KG Sevk') }}</div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('quality.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firma_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='firma_id' id="firma_id" class="form-control  @error('firma_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($firma as $list)
                                    <option value="{{$list->id}}" >{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('firma_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="firmadetay_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Detay') }}</label>

                            <div class="col-md-6">
                                <select name='firmadetay_id' id="firmadetay_id" class="form-control  @error('firmadetay_id') is-invalid @enderror" >

                                </select>
                                @error('firmadetay_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="sevktrh" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="sevktrh" type="date" class="form-control @error('sevktrh') is-invalid @enderror" name="sevktrh" value="{{ old('sevktrh') }}"  autocomplete="sevktrh" autofocus>
                                @error('sevktrh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vade" class="col-md-4 col-form-label text-md-right">{{ __('Vade') }}</label>

                            <div class="col-md-6">

                                <input id="vade" type="text" class="form-control @error('vade') is-invalid @enderror" name="vade" value="{{ old('vade') }}"  autocomplete="vade" autofocus>
                                @error('vade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="iskonta" class="col-md-4 col-form-label text-md-right">{{ __('İskonta') }}</label>

                            <div class="col-md-6">

                                <input id="iskonta" type="text" class="form-control @error('iskonta') is-invalid @enderror" name="iskonta" value="{{ old('iskonta') }}"  autocomplete="iskonta" autofocus>
                                @error('iskonta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="bazkur" class="col-md-4 col-form-label text-md-right">{{ __('Kur') }}</label>

                            <div class="col-md-6">

                                <input id="bazkur" type="number" step=".001" min="1" class="form-control @error('bazkur') is-invalid @enderror" name="bazkur" value="{{ old('bazkur') }}"  autocomplete="bazkur" autofocus>
                                @error('bazkur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="explanation" type="text" class="form-control"  name="explanation"  autocomplete="explanation" autofocus>
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Ekle') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
    
</style>
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
    $('#firma_id').select2({ width: '350px' });
    
    $("select[name='firma_id']").change(function(){
    $("#kur, #f").remove();
    var sid = $(this).val();
        if(sid){
            $.ajax({
             type:"get",
             url:'{{url('/order/firmadetay')}}/'+sid, 
             success:function(res)
             {     var kayitSay = res[0].firmadetay.length;  
                // console.log(kayitSay);
                if(kayitSay > 0)
                    { //console.log; 
                        $("select[name='firmadetay_id").empty();
                        $("input[name='vade").empty();
                        $("input[name='iskonta").empty();
                            //$("select[name*='kur_id").empty();

                            for (i=0; i < kayitSay; i++)
                            {
                                $("select[name='firmadetay_id']").append('<option value="'+res[0].firmadetay[i].id+'">vade='+res[0].firmadetay[i].vade+'  iskonta='+res[0].firmadetay[i].iskonta //+'   döviz='+res[0].firmadetay[i].kur.name
                                    +'</option>');
                            };
                            // $("select[id='nakliye1_id']").val(res[0].nakliye1_id);
                            $("input[name='vade']").val(res[0].firmadetay[0].vade);
                            $("input[name='iskonta']").val(res[0].firmadetay[0].iskonta);
                            // $("select[name='kur_id']select").val(res[0].firmadetay[0].kur_id);
                        }
                        else {
                           $("select[name='firmadetay_id").empty();
                           $("input[name='vade").val('');
                           $("input[name='iskonta").val('');
                           // $("select[name='kur_id']select").val('');
                       }
                       $("#firmadetay_id").after('<label id="f">Firma Döviz Cinsi=</label><label name="kur" id="kur">'+res[0].kur.name+'</label><input type="hidden" name="kur_id" value="'+res[0].kur_id+'">');
                    if ( res[0].kur.name == 'TL') 
                        { $("#bazkur").prop('required',false);}
                    else  { $("#bazkur").prop('required', true); }
                   }
               });
        }

    });
    $("select[name*='firmadetay_id']").change(function(){
                            //var a = $("select[name='firmadetay_id'] option:selected").text();
                            var id = $("select[name='firmadetay_id']").val();
                            if(id){
                                $.ajax ({
                                    type:'get',
                                    url:'{{url('/order/detay')}}/'+id, 
                                    success:function(detay){
                                        if (detay)
                                        {
                                            $("input[name='vade']").val(detay[0].vade);
                                            $("input[name='iskonta']").val(detay[0].iskonta);
                                            // $("select[name='kur_id']select").val(detay[0].kur_id);
                                        }
                                    }
                                });
                            }

                        }); 
       

                    </script>
                    @endsection