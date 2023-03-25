@extends('layouts.app')

@section('title')
Sign In | NTQ-Solution
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
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Velzon.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="myForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <div id="message"></div>      
                                        
                                        @if (Session::has('error_message'))
                                            <div class="alert alert-danger" role="alert">{{ Session::get('error_message') }}</div>
                                        @endif
                                    </div>  
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                        <span id="email_error" class="text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('auth.forgot-password') }}" class="text-muted">Forgot password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <span id="password_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember_me" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
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
                        <p class="mb-0">Don't have an account ? <a href="{{ route('auth.post-sign-up') }}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
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

            $('span[id*="_error"]').text('');

            $.ajax({
                url: "{{ route('auth.post-sign-in') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.error_message){
                        return $('#message').addClass('text-danger').text(response.error_message);
                    }else{
                        window.location.assign(response.url);
                    }
                },
                error: function(reject){
                    var response = $.parseJSON(reject.responseText);
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
     <!-- password-addon init -->
     <script src="assets/js/pages/password-addon.init.js"></script>
@endpush