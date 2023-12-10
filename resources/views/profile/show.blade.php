@extends('layouts.app2')

@section('title')
    {{ $user->name }}'s Profile | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
                                    <img src="{{ asset('storage/' . $user->image_path) }}" alt="..."
                                        style="width:40vw;max-width:400px">



                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 rounded mb-1-9">
                                        <h3 class="h2 text-white mb-0">{{ $user->name }}</h3>
                                        <span class="text-primary">{{ $user->email }}</span>
                                    </div>

                                    <ul class="list-unstyled mb-1-9">
                                        @if ($user->public_profile)
                                            <li class="mb-1 mb-xl-3 display-28"><span
                                                    class="display-26 text-secondary me-2 font-weight-600">Contact:</span>
                                                {{ $user->contact }}</li>
                                        @endif
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">SSC
                                                Group:</span>{{ $user->ssc_group }}
                                        </li>

                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">SSC Passing
                                                Year:</span>{{ $user->ssc_passing_year }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">HSC
                                                Group:</span>{{ $user->hsc_group }}
                                        </li>

                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">HSC Passing
                                                Year:</span>{{ $user->hsc_passing_year }}
                                        </li>
                                        @if ($user->public_profile)
                                            <li class="mb-1 mb-xl-3 display-28"><span
                                                    class="display-26 text-secondary me-2 font-weight-600">Address:</span>{{ $user->address }}
                                            </li>
                                        @endif



                                    </ul>
                                    @if (session('success-msg'))
                                        <div class="alert alert-success col-md-6 mb-3 container-fluid" role="alert">
                                            {{ session('success-msg') }}
                                        </div>
                                    @endif
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
