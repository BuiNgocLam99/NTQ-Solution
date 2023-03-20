@extends('layouts.app')

@section('title')
Sign Up | NTQ-Solution
@endsection

@section('content')
<div class="spinner-container">
    <div class="spinner-border spinner" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="auth-page-wrapper pt-5">

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="assets/images/logo-light.png" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Create New Account</h5>
                                <p class="text-muted">Get your free velzon account now</p>
                                <div id="message"></div>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="myForm" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                                        <span id="email_error" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter username" required>
                                        <span id="user_name_error" class="text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <span id="password_error" class="text-danger"></span>
                                        </div>
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
                                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
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
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account ? <a href="auth-signin-basic.html" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                    </div>

                </div>
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
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>

<script>
    $(document).ready(function(){
        
        $(".spinner-container").hide();

        $('#myForm').submit(function(e){
            e.preventDefault();

            $(".spinner-container").show();

            var formData = new FormData(this);

            $('span[id*="_error"]').text("");

            $.ajax({
                url: "{{ route('auth.post-sign-up') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner').show();
                },
                success: function(response){
                    $('#message').addClass('text-success').text(response.success_message);
                    $("input").val("");
                },
                error: function(reject){
                    var response = $.parseJSON(reject.responseText);
                    $('span[id*="_error"]').text("");
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
</script>
@endsection

@push('scripts')
    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="assets/js/pages/passowrd-create.init.js"></script>
@endpush