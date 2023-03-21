@extends('layouts.app')

@section('title')
    Forgot Password | NTQ-Solution
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
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <p class="text-muted">Reset password with velzon</p>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                        colors="primary:#8c68cd" class="avatar-xl"></lord-icon>

                                </div>
                                {{-- <img src="/public/images/spinner.gif" class="spinner"> --}}

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form id="myForm">
                                        @csrf

                                        <div class="mb-3">
                                            <div id="message"></div>
                                        </div>
  
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input name="email" class="form-control" id="email"
                                                placeholder="Enter Email">
                                            <span id="email_error" class="text-danger"></span>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password... <a href="{{ route('auth.sign-in') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
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
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <script>
        $(document).ready(function() {

            $(".spinner-container").hide();

            $('#myForm').submit(function(e) {
                e.preventDefault();

                $(".spinner-container").show();

                var formData = new FormData(this);

                $('span[id="_error"]').text('');

                $.ajax({
                    url: '{{ route('auth.post-forgot-password') }}',
                    'type': 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success_message) {
                            $('#message').removeClass('text-danger').addClass('text-success')
                                .text(response.success_message);
                        } else {
                            $('#message').removeClass('text-success').addClass('text-danger')
                                .text(response.error_message);
                        }
                    },
                    error: function(reject) {
                        var response = $.parseJSON(reject.responseText);

                        $.each(response.errors, function(key, val) {
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
@endpush
