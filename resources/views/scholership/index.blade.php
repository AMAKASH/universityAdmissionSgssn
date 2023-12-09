@extends('layouts.app2')

@section('title')
    All Scholerships | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Scholerships</h6>
                <h1 class="mb-5">All Scholerships</h1>
            </div>
            <div>

            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($scholerships as $scholership)
                    <x-scholership-card :scholership="$scholership" />
                @endforeach
                @if (count($scholerships) == 0)
                    <div style="height: 50vh">
                        <h3 class="text-center mt-5">No Scholerships Available Matching your criteria</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-search-comp title="Scholerships" :criteria="$search_criterias" />
@endsection
