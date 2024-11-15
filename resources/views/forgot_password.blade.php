@extends('layout_user')
@section('content')
<div class="container-fluid">
    <!-- Start col -->
    <div class="album py-5" style="height:82vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="margin-top: 4%;max-width: 35rem;padding: 2%;">

                <div>
                    <h2> Forgot Password</h2>
                    <a href="{{ route('login') }}" class="float-end btn btn-outline-dark"
                        style="margin-top: -9%;">Login</a>
                </div>
                <hr>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{route('processForgotpassword')}}" method="POST" name="forgotPassForm"
                        enctype="multipart/from-data">
                        @csrf

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" required="required"
                                placeholder="Enter email">
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="forgot_pass_btn" class="btn btn-outline-success"
                                value="Send Email">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection