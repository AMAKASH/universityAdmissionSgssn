@props(['title', 'criteria' => []])

<button class="btn btn-lg btn-primary btn-lg-square search-icon-sticky" data-bs-toggle="modal"
    data-bs-target="#modal-report"><i class="bi bi-search"></i></button>
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Search Phrase</label>
                            <input type="text" id="search-phrase"class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Criteria</label>
                        <select class="form-select" id="search-criteria">
                            {{-- <option value="1" selected="">Name</option>
                            <option value="2">Location</option>
                            <option value="3">Majors</option>
                            <option value="4">Admission Requirement</option>
                            <option value="5">Tuition Cost</option> --}}
                            @foreach ($criteria as $key => $value)
                                <option value="{{ $key }}" {{ $loop->index == 0 ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn  link-danger" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button onclick="search_button_click()" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function search_button_click() {
        //console.log("url")
        let phrase_input = document.getElementById('search-phrase');
        let crit = document.getElementById('search-criteria');
        let phrase = phrase_input.value.replace(" ", "_");
        if (phrase == "") {
            return;
        }

        let url = location.protocol + '//' + location.host + location.pathname +
            `?search=${phrase}&criteria=${crit.value}`;
        window.location.href = url;
    }
</script>
