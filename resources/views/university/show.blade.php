@extends('layouts.app2')

@section('title')
    {{ $university->name }} | {{ config('app.name', 'Laravel') }}
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
                                    <img src="{{ asset('img/university/' . $university->image_path) }}" alt="..."
                                        style="width:60vw;max-width:600px">
                                    <a class="btn btn-primary d-lg-block col-lg-5 col-md-5 mt-3 py-3 px-3 mb-1-9 rounded"
                                        href="{{ route('application.create', $university->id) }}">Apply Now</a>
                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 rounded mb-1-9">
                                        <h3 class="h2 text-white mb-0">{{ $university->name }}</h3>
                                        <span class="text-primary">{{ $university->address }}</span>
                                    </div>

                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">User Rating:</span>
                                            7.0/10</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Total
                                                Students:</span> {{ $university->total_students }}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Admission
                                                Statistics:</span>
                                            {{ $university->admission_stat }}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Contact:</span>
                                            {{ $university->contact }}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Next Admission
                                                Intake:</span>
                                            {{ $university->next_addmission_intake }}</li>
                                        <li class=" mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Application
                                                Deadline:</span>
                                            {{ date('d-m-Y', strtotime($university->next_addmission_deadline)) }}</li>
                                        <li class="display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Tentative Tuition
                                                Cost:
                                            </span>
                                            {{ $university->tentative_tution_cost }}</li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div>
                        <span class="section-title text-primary mb-3 mb-sm-4">Campus Facilities</span>

                        <p class="mb-0">
                            {!! str_replace("\n", '<br>', $university->campus_facilities) !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 mb-4 mb-sm-5">
                            <div class="mb-4 mb-sm-5">
                                <span class="section-title text-primary mb-3 mb-sm-4">Majors Offered</span>

                                <div class="row">
                                    @foreach ($university->majors as $uni_major)
                                        <div class="card mb-3 me-2 wow fadeInUp" style="width: 25rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $uni_major->major->name }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $uni_major->total_credit }}
                                                    Credits</h6>
                                                <h6 class="card-subtitle mb-2 text-muted">Per Credit Cost: Tk.
                                                    {{ $uni_major->credit_fee }}</h6>
                                                <p class="card-text">Requirements:<br>
                                                    {{ $uni_major->application_requirements }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4 mb-sm-5">
                                <span class="section-title text-primary mb-3 mb-sm-4">Scholerships Offered</span>
                                <div class="row">
                                    @foreach ($university->scholerships as $scholership)
                                        <x-scholership-card :scholership="$scholership" />
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4 mb-sm-5">
                                <span class="section-title text-primary mb-3 mb-sm-4">Grading Policy</span>

                                <p>
                                    {!! str_replace("\n", '<br>', $university->grading_system) !!}
                                </p>

                            </div>
                            <div class="mt-3">
                                <span class="section-title text-primary mb-3 mb-sm-4">Map Location</span>
                                <div>
                                    <iframe title="Map Location" src="{{ $university->map_url }}"
                                        style="border:0;width:80vw;height:30rem;max-width:850px" allowfullscreen="true"
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>


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
