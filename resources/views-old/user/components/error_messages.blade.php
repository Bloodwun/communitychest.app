@if (session()->get('success'))
<div aria-live="polite" aria-atomic="true">
                                                <div style = "width: unset;" class="toast fade show align-items-center text-white bg-success border-0 mt-2"
                                                    role="alert" aria-live="assertive" aria-atomic="true">
                                                    <div class="d-flex">
                                                        <div class="toast-body">
                                                        {{ session()->get('success') }}
                                                        </div>
                                                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>

@endif
@if (session('fail'))
<div aria-live="polite" aria-atomic="true">
                                                <div style = "width: unset;" class="toast fade show align-items-center text-white bg-danger border-0 mt-2"
                                                    role="alert" aria-live="assertive" aria-atomic="true">
                                                    <div class="d-flex">
                                                        <div class="toast-body">
                                                        {{ session()->get('fail') }}
                                                        </div>
                                                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>
@endif
@if ($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
        <div aria-live="polite" aria-atomic="true">
                                                <div style = "width: unset;" class="toast fade show align-items-center text-white bg-danger border-0 mt-2"
                                                    role="alert" aria-live="assertive" aria-atomic="true">
                                                    <div class="d-flex">
                                                        <div class="toast-body">
                                                            {{$error}}
                                                        </div>
                                                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            </div>
            @endforeach
        </ul>
@endif
