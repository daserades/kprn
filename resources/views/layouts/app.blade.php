<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/family.css') }}" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                         <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Süreç</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('uretim.index') }}">Üretim</a>
                                <a class="dropdown-item" href="{{ route('uretimbot') }}">Bot'lu Üretim</a>
                                <a class="dropdown-item" href="{{ route('store.index') }}">Depo Stok</a>
                                <a class="dropdown-item" href="{{ route('urunagaci') }}">Ürün Ağacı</a>
                                <a class="dropdown-item" href="{{ route('order.index') }}">Sipariş</a>
                                <a class="dropdown-item" href="{{ route('report') }}">Sipariş Raporu</a>
                                <a class="dropdown-item" href="{{ route('pay.index') }}">Ödeme</a>
                                <a class="dropdown-item" href="{{ route('current.index') }}">Firma Cari Kapama</a>
                                <a class="dropdown-item" href="{{ route('shipping.index') }}">Sevkiyat</a>
                                <a class="dropdown-item" href="{{ route('kindex') }}">Kapanan Sevkiyat</a>
                                <a class="dropdown-item" href="{{ route('ship') }}">Sevkiyat Fişleri</a>
                                <a class="dropdown-item" href="{{ route('shipping.create') }}">İrsaliye</a>
                                <a class="dropdown-item" href="{{ route('bot.index') }}">Botlar</a>
                                <a class="dropdown-item" href="{{ route('delete') }}">Etiket Silme</a>
                                <a class="dropdown-item" href="{{ route('sayim.index')}} ">Sayım Devir İşlemleri</a>
                                <!-- <a class="dropdown-item" href="{{ route('kgsevk')}} ">Standart Dışı Ürün Sevk</a> -->
                                <a class="dropdown-item" href="{{ route('quality.index')}} ">Standart Dışı Ürün Sevk</a>
                                <a class="dropdown-item" href="{{ route('urunreport')}} ">Ürün Bazında Satış Raporu</a>
                                <a class="dropdown-item" href="{{ route('urunreport2')}} ">Ürün Bazında Satış Raporu Kod Bazında</a>
                                <a class="dropdown-item" href="{{ route('urunreport3')}} ">Ürün Hareket Raporu</a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Tanımlar</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('urun.index') }}">Ürün</a>
                                <a class="dropdown-item" href="{{ route('price.index') }}">Fiyatlar</a>
                                <a class="dropdown-item" href="{{ route('gorevlistesi.index') }}">Görev Listesi</a>
                                <a class="dropdown-item" href="{{route('departman.index')}}">Departman</a>
                                <a class="dropdown-item" href="{{route('firmatipi.index')}}">Firmatipi</a>
                                <a class="dropdown-item" href="{{route('firma.index')}}">Firma</a>
                                <a class="dropdown-item" href="{{route('firmadetay.index')}}">Firma Detay</a>
                                <a class="dropdown-item" href="{{route('yetkili.index')}}">Yetkili</a>
                                <a class="dropdown-item" href="{{route('ambalajtur.index')}}">Ambalaj Türü</a>
                                <a class="dropdown-item" href="{{route('paketiciozellik.index')}}">Paket İçi Özellik</a>
                                <a class="dropdown-item" href="{{route('renk.index')}}">Renk</a>
                                <a class="dropdown-item" href="{{route('urunozellik.index')}}">Ürün Özellik</a>
                                <a class="dropdown-item" href="{{route('urunkategori.index')}}">Ürün Kategori</a>
                                <a class="dropdown-item" href="{{route('urunaltkategori.index')}}">Ürün Alt Kategori</a>
                                <a class="dropdown-item" href="{{route('model.index')}}">Model</a>
                                <a class="dropdown-item" href="{{route('ebat.index')}}">Ebat</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name.' '.Auth::user()->surname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('usercreate') }}">Kullanıcı Kayıt</a>
                                <a class="dropdown-item" href="{{ route('password.changee') }}">Parola Güncelleme</a>
                                <a class="dropdown-item" href="{{route('personel.index')}}">Personel</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Oturumu Kapat') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main >
        @yield('content')
    </main>
</div>
</body>

@yield('js')
</html>
