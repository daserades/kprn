@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                            {{ __('Üretim') }}
                        </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('uretim.store') }}">
                        @csrf
                            <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-center" id="yazi">{{ __('Ürün Kodu  :') }}{{$urun->no}}</label>
                            </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-center" id="yazi">{{ __('Ürün İsmi  :') }}{{$urun->name}}</label>
                            </div>
                             <div class="form-group row">
                                <input id="name" type="hidden"  name="id" value="{{$id}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-12">
                                <center>
                                    
                                <button type="submit" id="submit" name="asd" class="btn btn-success">
                                    {{ __('Üret') }}
                                </button>
                                </center>
                                <a href="{{ route('uretim.index')}}" name="asd" style="color:black"><i class="fas fa-long-arrow-alt-left fa-4x"></i></a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('css')
<style type="text/css">
 button[name='asd'] {
    width: 440px;
    height: 300px;
}
#yazi {
        font-size: 20px;
        font-weight: bold;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('keypress',function(e) {
    if(e.which == 13) {
        $('#submit').click();
    }
});
</script>
@endsection