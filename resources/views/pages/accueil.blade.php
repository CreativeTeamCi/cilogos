@extends('layouts.master')

@section('title', 'Accueil')

@push('styles')

@endpush

@section('content')
<!-- Main -->
<div class="crt-main">
    <div class="crt-main__title">
        <div class="crt-main__title-img">
            <img src="{{ asset('assets/images/logo.png') }}">
        </div>
        <h1>
            CI Logos, une collection <a href="https://github.com/CreativeTeamCi/cilogos" target="_blank">open source</a> de logos d'entreprise ivoiriennes de haute qualité pour une utilisation gratuite.
        </h1>
        <a href="https://github.com/CreativeTeamCi/cilogos" target="_blank">
            <button class="crt__btn__contribute">
                <i class="fa fa-github"></i>
                &nbsp;
                Contribuer sur GitHub
            </button>
        </a>

        <a href="{{ route('submission.index') }}">
            <button class="crt__btn__submission">
                <i class="fa fa-paper-plane"></i>
                &nbsp;
                Soumettre un logo
            </button>
        </a>
    </div>
    @foreach ($business_logo as $logo)
        <div class="crt__logo contsearch3">
            <div class="crt__logo__holder">
                <div class="crt__logo__image">
                    <img src='{{ asset($logo->logo_png) }}' alt='{{ $logo->business_name }}'>
                </div>
                <div class="crt__logo__download">
                    <div class="crt__logo__download__overlay">
                        @if ($logo->logo_svg)
                            <a href="{{ asset($logo->logo_svg) }}" download="{{ $logo->business_name }} SVG Logo">
                                <span class="crt__logo__download__overlay--svg">
                                    Télécharger SVG
                                </span>
                            </a>
                        @endif

                        <a href="{{ asset($logo->logo_png) }}" download="{{ $logo->business_name }} PNG Logo">
                            <span class="crt__logo__download__overlay--png">
                                Télécharger PNG
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="crt__logo__text">
                <p class="crt__logo__text--primary gsearch">
                    @if ($logo->url)
                        <a href="{{ $logo->url }}" target="_blank">{{ $logo->business_name }}</a>
                    @else
                        {{ $logo->business_name }}
                    @endif
                </p>
                <p class="crt__logo__text--secondary gsearch">{{ $logo->activity_area }}</p>
            </div>
        </div> <!-- end crt-logo -->
        <div id="crt__search"></div>
    @endforeach
</div>
@endsection

@push('scripts')

@endpush
