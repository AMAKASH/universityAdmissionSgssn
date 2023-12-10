@extends('layouts.app2')

@section('title')
    Apply to {{ $university->name }} | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
@endsection
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Application</h6>
                <h1 class="mb-5">{{ $university->name }}</h1>
            </div>

            <div class="row g-4 justify-content-center">
                <form class="row g-3" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="major" class="form-label">Choose Major</label>
                            <select id="major" name="major" class="form-select">
                                <option selected>Choose Major</option>
                                @foreach ($university->majors as $unimajors)
                                    <option value="{{ $unimajors->id }}">{{ $unimajors->major->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('major')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name or leave blank" value="{{ $user->name }}" disabled>

                    </div>
                    <div class="col-md-6">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="tel" class="form-control" id="contact" name="contact"
                            placeholder="Enter Phone number or leave blank" value="{{ $user->contact }}" disabled>

                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" name="address"
                            placeholder="Enter Address or leave blank" value="{{ $user->address }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="ssc_group" class="form-label">SSC Group</label>
                        <input type="text" class="form-control" id="ssc_group" name="ssc_group"
                            value="{{ $user->ssc_group }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="ssc_roll" class="form-label">SSC Roll</label>
                        <input type="text" class="form-control" id="ssc_roll" name="ssc_roll"
                            value="{{ $user->ssc_roll_no }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="ssc_result" class="form-label">SSC Result</label>
                        <input type="text" class="form-control" id="ssc_result" name="ssc_result"
                            value="{{ $user->ssc_result }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="ssc_year" class="form-label">SSC Passing Year</label>
                        <input type="text" class="form-control" id="ssc_year" name="ssc_year"
                            value="{{ $user->ssc_passing_year }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="hsc_group" class="form-label">HSC Group</label>
                        <input type="text" class="form-control" id="hsc_group" name="hsc_group"
                            value="{{ $user->hsc_group }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="hsc_roll" class="form-label">HSC Roll</label>
                        <input type="text" class="form-control" id="hsc_roll" name="hsc_roll"
                            value="{{ $user->hsc_roll_no }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="hsc_result" class="form-label">HSC Result</label>
                        <input type="text" class="form-control" id="hsc_result" name="hsc_result"
                            value="{{ $user->hsc_result }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="hsc_year" class="form-label">HSC Passing Year</label>
                        <input type="text" class="form-control" id="hsc_year" name="hsc_year"
                            value="{{ $user->hsc_passing_year }}" disabled>

                    </div>
                    <div class="col-md-3">
                        <label for="nid" class="form-label">NID/Birth Certifiacte No.</label>
                        <input type="text" class="form-control" id="nid" name="nid"
                            placeholder="NID / Birth Certificate No">
                        <x-input-error :messages="$errors->get('nid')" class="mt-2" />
                    </div>

                    <div class="col-md-12">
                        <p> The Informations are automatically filled up from your profile. To change any info please update
                            it in your profile.</p>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary text-center mx-auto">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
