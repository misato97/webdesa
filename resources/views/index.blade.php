@extends('layouts.layout')
@section('title', 'Website Resmi Pemerintah Desa '. $desa->nama_desa  .' - Beranda')

@section('styles')
<meta name="description" content="Website Resmi Pemerintah Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->nama_kecamatan }}, Kabupaten {{ $desa->nama_kabupaten }}. Melayani pembuatan surat keterangan secara online">

<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
</style>
@endsection

@section('header')
<h1 class="text-white text-sm text-muted">SELAMAT DATANG DI LAYANAN ONLINE</h1>
<h2 class="text-lead text-white">DESA {{ Str::upper($desa->nama_desa) }}<br/>KABUPATEN {{ Str::upper($desa->nama_kabupaten) }}</h2>
@endsection

@section('content')
<div class="row">
    <div class="col-md">
        <div id="owl-one" class="owl-carousel owl-theme" style="z-index: 0">
            @foreach($gallery as $key => $item)
                <a href="{{ asset(Storage::url($item->gallery)) }}" data-fancybox>
                    <img src="{{ asset(Storage::url($item->gallery)) }}" class="mw-100" alt="Slide Show {{ $key }}">
                </a>
            @endforeach
        </div>
    </div>
</div>
<section id="services">
    <div class="row">
        <div class="col-md">
            <div class="header-body text-center mt-5 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 border-bottom">
                        <h2 class="text-white">LAYANAN</h2>
                        <p class="text-white">Dengan menggunakan layanan online website Desa {{ $desa->nama_desa }}, masyarakat dapat dengan mudah membuat beberapa surat keterangan berikut ini secara online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        @forelse ($surat as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-service bg-white rounded shadow p-3">
                    <a href="{{ route('buat-surat', ['id' => $item->id,'slug' => Str::slug($item->nama)]) }}">
                        <i class="fas {{ $item->icon }} ikon fa-5x mb-3"></i>
                        <h4>{{ $item->nama }}</h4>
                    </a>
                    <p>{{ $item->deskripsi }}</p>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="single-service bg-white rounded shadow">
                    <h4>Data belum tersedia</h4>
                </div>
            </div>
        @endforelse
    </div>
</section>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31625.720596770105!2d114.11304636870697!3d-7.76700264173978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6d545ddf5f2f9%3A0x9cfd691bacf76cda!2sKetowan%2C%20Kec.%20Arjasa%2C%20Kabupaten%20Situbondo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1599369268515!5m2!1sid!2sid"  width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
@endsection

@push('scripts')
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#owl-one').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            smartSpeed:1000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });

</script>
@endpush
