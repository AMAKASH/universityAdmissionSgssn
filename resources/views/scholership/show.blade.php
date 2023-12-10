@extends('layouts.app2')

@section('title')
    {{ $scholership->name }} | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
@endsection
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0">
                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <img src="{{ asset('img/university/' . $scholership->university->image_path) }}"
                                        alt="..." width="600px">
                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 rounded mb-1-9">
                                        <h3 class="h2 text-white mb-0">{{ $scholership->name }}</h3>
                                        <span class="text-primary">{{ $scholership->university->name }}</span>
                                    </div>

                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Award:</span>
                                            {{ $scholership->award }}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Deadline:</span>
                                            {{ $scholership->deadline }}
                                        </li>

                                    </ul>

                                    <a class="btn btn-primary d-lg-block col-lg-5 col-md-5 mt-3 py-3 px-3 mb-1-9 rounded"
                                        href="{{ route('scholership.track', $scholership->id) }}">Track</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4 mb-4 mb-sm-5">
                        <div>
                            <span class="section-title text-primary mb-3 mb-sm-4">Eligibility Criteria</span>

                            <p class="mb-0">
                                {!! str_replace("\n", '<br>', $scholership->criteria) !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="mb-4 mb-sm-5">
                            <span class="section-title text-primary mb-3 mb-sm-4">Application Requirements</span>

                            <p>
                                {!! str_replace("\n", '<br>', $scholership->requirements) !!}
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
