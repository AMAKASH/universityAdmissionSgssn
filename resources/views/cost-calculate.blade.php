@extends('layouts.app2')

@section('title')
    Cost Calculator | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
@endsection
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Calculate University Fees</h6>
                <h1 class="mb-5">Cost Calculator</h1>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="row g-3">



                    <div class="col-md-6">
                        <label for="university" class="form-label">Choose University</label>
                        <select id="university" name="university" class="form-select">
                            <option selected>Choose University</option>
                            @foreach ($universities as $university)
                                <option value="{{ $university->id }}">{{ $university->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="major" class="form-label">Choose Major</label>
                        <select id="major" name="major" class="form-select">
                            <option selected>Choose Major</option>

                        </select>
                    </div>


                    <div class="col-md-3">
                        <label for="credit" class="form-label">Total Credit</label>
                        <input type="number" class="form-control" id="credit" name="credit" placeholder="Total Credit"
                            min="0">

                    </div>
                    <div class="col-md-3">
                        <label for="credit-fee" class="form-label">Credit Fee</label>
                        <input type="number" class="form-control" id="credit-fee" name="credit-fee"
                            placeholder="Per Credit Fee" min="0">

                    </div>
                    <div class="col-md-3">
                        <label for="book-fee" class="form-label">Books Cost</label>
                        <input type="number" class="form-control" id="book-fee" name="book-fee"
                            placeholder="Add book costs if applicable" min="0">

                    </div>
                    <div class="col-md-3">
                        <label for="housing-fee" class="form-label">Housing Cost</label>
                        <input type="number" class="form-control" id="housing-fee" name="housing-fee"
                            placeholder="Add housing costs if applicable" min="0">

                    </div>
                    <div class="col-md-3">
                        <label for="additional-fee" class="form-label">Additional Cost</label>
                        <input type="number" class="form-control" id="additional-fee" name="additional-fee"
                            placeholder="Add any additional fees if applicable" min="0">

                    </div>
                    <div class="col-md-6">
                        <label for="scholership-percent" class="form-label">Scholership Tuition Fee waiver
                            (percentage)</label>
                        <input type="number" class="form-control" id="scholership-percent" name="scholership-percent"
                            placeholder="Enter only percentage value, no % sign is required" min="0">

                    </div>

                    <div class="col-md-3">
                        <label for="scholership-additional" class="form-label">Additional Schorlership </label>
                        <input type="number" class="form-control" id="scholership-additional" name="scholership-additional"
                            placeholder="Enter any additional scholerships" min="0">

                    </div>


                    <button class="btn btn-primary" onclick="javascript:calculate_cost()"> Calculate</button>

                </div>
                <div class="col-12 text-center">
                    <p>The total calculated Cost is Tk.
                        <strong id="total_cost" class="d-inline-block">0.00</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let getMajorsUrl = "{{ route('api.majors.university', 0) }}".slice(0, -1);
        let getMajorDataUrl = "{{ route('api.data.major', 0) }}".slice(0, -1);

        let universitySelector = document.getElementById('university');
        let majorSelector = document.getElementById('major');
        let creditElement = document.getElementById('credit');
        let creditFeeElement = document.getElementById('credit-fee');
        let bookFeeElement = document.getElementById('book-fee');
        let housingFeeElement = document.getElementById('housing-fee');
        let additinalFeeElement = document.getElementById('additional-fee');
        let scholershipPercentElement = document.getElementById('scholership-percent');
        let scholershipAdditionalElement = document.getElementById('scholership-additional');
        let totalCostElement = document.getElementById('total_cost');


        universitySelector.onchange = function() {
            console.log(universitySelector.value);
            fetch(getMajorsUrl + universitySelector.value, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => process_major_data(data));
        }

        function process_major_data(data) {
            console.log(data.majors);
            totalCostElement.innerHTML
            removeOptions(majorSelector);
            var opt = document.createElement('option');

            opt.innerHTML = "Choose Major";
            opt.setAttribute('selected', true);
            majorSelector.appendChild(opt);

            for (var i = 0; i < data.majors.length; i++) {
                var opt = document.createElement('option');
                opt.value = data.majors[i][0];
                opt.innerHTML = data.majors[i][1];;
                majorSelector.appendChild(opt);
            }
            creditElement.value = "";
            creditFeeElement.value = "";
        }

        function removeOptions(selectElement) {
            var i, L = selectElement.options.length - 1;
            for (i = L; i >= 0; i--) {
                selectElement.remove(i);
            }
        }

        majorSelector.onchange = function() {
            console.log(majorSelector.value);
            fetch(getMajorDataUrl + majorSelector.value, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => process_credit_data(data));
        }

        function process_credit_data(data) {
            console.log(data);
            creditElement.value = data.total_credit;
            creditFeeElement.value = data.credit_fee;
        }

        function calculate_cost() {
            console.log('calculating cost..')
            let total_cost = Number(creditElement.value) * Number(creditFeeElement.value) + Number(bookFeeElement.value) +
                Number(housingFeeElement.value) + Number(additinalFeeElement.value);

            total_cost = total_cost * (100 - Number(scholershipPercentElement.value)) / 100
            total_cost = total_cost - Number(scholershipAdditionalElement.value);


            totalCostElement.innerHTML = total_cost.toFixed(2);
        }
    </script>
@endsection
