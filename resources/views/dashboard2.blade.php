@extends('layouts.app2')

@section('title')
    Dashboard | {{ config('app.name', 'Laravel') }}
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
                                    <img src="{{ asset('storage/' . $user->image_path) }}" alt="..." class="mx-auto"
                                        style="width:40vw;max-width:400px;">

                                    <div class="row">
                                        <form action="{{ route('upload-image') }}" method="POST" id="img-upload-form"
                                            enctype='multipart/form-data' class="col-md-7">
                                            @csrf
                                            @method('PATCH')
                                            <label for="img-upload"
                                                class="btn btn-primary d-lg-block col-lg-5 col-md-5 mt-3 py-3 px-3 mb-1-9 rounded">Upload
                                                Image</label>
                                            <input type="file" id="img-upload" name="img" class="d-none"
                                                accept="image/jpeg,image/png,image/jpg">
                                        </form>
                                        <div>
                                            <a href="{{ route('user.password.reset') }}"
                                                class="btn btn-primary d-lg-block col-lg-5 col-md-5 mt-3 py-3 px-2 mb-1-9 rounded">Reset
                                                Password</a>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-6 px-xl-10">
                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 rounded mb-1-9">
                                        <h3 class="h2 text-white mb-0">{{ $user->name }}</h3>
                                        <span class="text-primary">{{ $user->email }}</span>
                                    </div>

                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Contact:</span>
                                            {{ $user->contact }}</li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">SSC
                                                Group:</span>{{ $user->ssc_group }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">SSC Roll
                                                No:</span>{{ $user->ssc_roll_no }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">SSC
                                                Result:</span>{{ $user->ssc_result }}
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
                                                class="display-26 text-secondary me-2 font-weight-600">HSC Roll
                                                No:</span>{{ $user->hsc_roll_no }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">HSC
                                                Result:</span>{{ $user->hsc_result }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">HSC Passing
                                                Year:</span>{{ $user->hsc_passing_year }}
                                        </li>
                                        <li class="mb-1 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Address:</span>{{ $user->address }}
                                        </li>
                                        <li class="display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Profile
                                                Visibility:</span>{{ $user->public_profile ? 'Public' : 'Private' }}
                                        </li>


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
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div>
                        <span class="section-title text-primary mb-3 mb-sm-4">Edit Profile Information</span>
                        <form class="row g-3" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name or leave blank" value="{{ $user->name }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    placeholder="Enter Phone number or leave blank" value="{{ $user->contact }}">
                                <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="address"
                                    placeholder="Enter Address or leave blank" value="{{ $user->address }}">
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="ssc_group" class="form-label">SSC Group</label>
                                <input type="text" class="form-control" id="ssc_group" name="ssc_group"
                                    value="{{ $user->ssc_group }}">
                                <x-input-error :messages="$errors->get('ssc_group')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="ssc_roll" class="form-label">SSC Roll</label>
                                <input type="text" class="form-control" id="ssc_roll" name="ssc_roll"
                                    value="{{ $user->ssc_roll_no }}">
                                <x-input-error :messages="$errors->get('ssc_roll')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="ssc_result" class="form-label">SSC Result</label>
                                <input type="text" class="form-control" id="ssc_result" name="ssc_result"
                                    value="{{ $user->ssc_result }}">
                                <x-input-error :messages="$errors->get('ssc_result')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="ssc_year" class="form-label">SSC Passing Year</label>
                                <input type="text" class="form-control" id="ssc_year" name="ssc_year"
                                    value="{{ $user->ssc_passing_year }}">
                                <x-input-error :messages="$errors->get('ssc_year')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="hsc_group" class="form-label">HSC Group</label>
                                <input type="text" class="form-control" id="hsc_group" name="hsc_group"
                                    value="{{ $user->hsc_group }}">
                                <x-input-error :messages="$errors->get('hsc_group')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="hsc_roll" class="form-label">HSC Roll</label>
                                <input type="text" class="form-control" id="hsc_roll" name="hsc_roll"
                                    value="{{ $user->hsc_roll_no }}">
                                <x-input-error :messages="$errors->get('hsc_roll')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="hsc_result" class="form-label">HSC Result</label>
                                <input type="text" class="form-control" id="hsc_result" name="hsc_result"
                                    value="{{ $user->hsc_result }}">
                                <x-input-error :messages="$errors->get('hsc_result')" class="mt-2" />
                            </div>
                            <div class="col-md-3">
                                <label for="hsc_year" class="form-label">HSC Passing Year</label>
                                <input type="text" class="form-control" id="hsc_year" name="hsc_year"
                                    value="{{ $user->hsc_passing_year }}">
                                <x-input-error :messages="$errors->get('hsc_year')" class="mt-2" />
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="public_profile"
                                        {{ $user->public_profile ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridCheck">
                                        Make Profile Public
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div>
                        <span class="section-title text-primary mb-3 mb-sm-4">Applications</span>
                        <table id="applications" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">University</th>
                                    <th scope="col">Major</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Admission Decision</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->applications as $uniapplication)
                                    <tr>
                                        <th scope="col">{{ $loop->index + 1 }}</th>
                                        <td>{{ $uniapplication->university->name }}</td>
                                        <td>{{ $uniapplication->university_major->major->name }}</td>
                                        <td>{{ $uniapplication->status }}</td>
                                        <td>{{ $uniapplication->admission_decision }}</td>
                                        <td><a href="{{ route('application.destroy', $uniapplication->id) }}"
                                                class="btn btn-danger rounded">Delete</a></td>
                                    </tr>
                                @endforeach
                                @if (count($user->applications) == 0)
                                    <tr>
                                        <td colspan='6'>
                                            <h6 class="text-center">No Application submitted yet</h6>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-secondary" onclick="javascript:exportFromHTML()">Export Applications</button>
                </div>

                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div>
                        <span class="section-title text-primary mb-3 mb-sm-4">Scholerships</span>
                        <table id="scholerships" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">University</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Award</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->scholerships as $user_scholership)
                                    <tr>
                                        <th scope="col">{{ $loop->index + 1 }}</th>
                                        <td>{{ $user_scholership->university->name }}</td>
                                        <td><a
                                                href="{{ route('scholership.show', $user_scholership->id) }}">{{ $user_scholership->name }}</a>
                                        </td>
                                        <td>{{ $user_scholership->award }}</td>
                                        <td>{{ $user_scholership->deadline }}</td>
                                        <td><a href="{{ route('scholership.untrack', $user_scholership->id) }}"
                                                class="btn btn-danger rounded">Untrack</a></td>
                                    </tr>
                                @endforeach
                                @if (count($user->scholerships) == 0)
                                    <tr>
                                        <td colspan='6'>
                                            <h6 class="text-center">No Scholerships are being tracked yet</h6>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.19/jspdf.plugin.autotable.min.js"></script>
    <script>
        let input_img = document.getElementById('img-upload');
        let form = document.getElementById('img-upload-form');

        input_img.onchange = function() {
            form.submit();
        }

        function exportFromHTML() {
            window.jsPDF = window.jspdf.jsPDF;
            var doc = new jsPDF();
            doc.text("Applications | University Admission Suggestion", 50, 10);
            doc.autoTable({
                html: '#applications',

            });
            doc.save('UAS_application_{{ $user->name }}.pdf');
        }
    </script>
@endsection
