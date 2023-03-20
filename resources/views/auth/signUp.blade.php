@extends('layouts.app')

@section('title')
Sign Up | NTQ-Solution
@endsection

@section('content')
{{-- <div class="spinner-container">
    <div class="spinner-border spinner" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> --}}
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden m-0 card-bg-fill border-0 card-border-effect-none">
                        <div class="row justify-content-center g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="index.html" class="d-block">
                                                <img src="assets/images/logo-light.png" alt="" height="18">
                                            </a>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <i class="ri-double-quotes-l display-4 text-success"></i>
                                            </div>

                                            <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner text-center text-white pb-5">
                                                    <div class="carousel-item active">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end carousel -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Register Account</h5>
                                        <p class="text-muted">Get your Free Velzon account now.</p>
                                        <h3 id="message" class="text-success"></h3>
                                    </div>

                                    <div class="mt-4">
                                        <form class="needs-validation myForm" novalidate action="">
                                            @csrf

                                            <div class="mb-3">
                                                @if (Session::has('success_message'))
                                                    <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                                                @endif
                                                @if (Session::has('error_message'))
                                                    <div class="alert alert-danger" role="alert">{{ Session::get('error_message') }}</div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
                                                <span id="email_error" class="text-danger"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
                                                <span id="name_error" class="text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone number <span class="text-danger">*</span></label>
                                                <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" required>
                                                <span id="phone_number_error" class="text-danger"></span>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" name="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                                <span id="password_error" class="text-danger"></span>
                                            </div>

                                            <div class="mb-4">
                                                <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Velzon <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                            </div>

                                            <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                <h5 class="fs-13">Password must contain:</h5>
                                                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <div class="signin-other-title">
                                                    <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                                </div>

                                                <div>
                                                    <a href="https://www.facebook.com/" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></a>
                                                    <a href="https://www.google.com/" target="_blank" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></a>
                                                    <a href="https://www.github.com/" target="_blank" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></a>
                                                    <a href="https://www.twitter.com/" target="_blank" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        {{-- <p class="mb-0">Already have an account ? <a href="{{ route('user.sign-in') }}" class="fw-semibold text-primary text-decoration-underline"> Signin</a> </p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy;
                            <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>

{{-- <script>
    $(document).ready(function(){
        
        $(".spinner-container").hide();

        $('.myForm').submit(function(e){
            e.preventDefault();

            $(".spinner-container").show();

            var formData = new FormData(this);

            var fieldNames = [...formData.keys()];

            var filteredFieldNames = fieldNames.filter(function(fieldName) {
                return fieldName !== '_token';
            });

            $.each(filteredFieldNames, function(key, value) {
                $('span[id="' + value + '_error"]').text('');
            });

            $.ajax({
                url: "{{ route('user.submit-sign-up') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner').show();
                },
                success: function(response){
                    $('#message').text(response[1])
                },
                error: function(reject){
                    var response = $.parseJSON(reject.responseText);
                    $('span[id*="_error"]').each(function() {
                        $(this).text('');
                    });
                    $.each(response.errors, function(key, val){
                        $("#" + key + "_error").text(val[0]);
                    })
                },
                complete: function() {
                    $(".spinner-container").hide();
                }
            })
        })
    })
</script> --}}
@endsection

@push('scripts')
    <!-- validation init -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="assets/js/pages/passowrd-create.init.js"></script>
@endpush