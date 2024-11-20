@extends('admin.admin_layout')
@section('section')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - LearnVern Store Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div class="container-fluid">
        <!-- Start col -->
        <div class="album py-5" style="height:150vh;margin-top: -5%;margin-bottom: -8%;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-success" style="max-width: 65rem;padding: 2%;">
                    <div>
                        <h2> User Add</h2>
                        <a href="{{route("user_list")}}" class="float-end btn btn-outline-dark"
                            style="margin-top: -5%;">Home</a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                 
                    <hr>
                    <div class="card-body">
                        <form method="POST" action="{{route("add_user_data")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Meet"
                                        required="">
                                </div>
                                <div class="col">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Shah"
                                        required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" required="">
                                </div>
                                <div class="col">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                        placeholder="1234567890" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="password" class="form-label">Password</label><br>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password" required="">
                                </div>
                                <div class="col">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male"
                                        checked>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female">&nbsp;&nbsp;Female
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address"
                                        placeholder="address" required=""></textarea>
                                </div>
                                <div class="col">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" aria-label="Default select example"
                                        required="" name="country">
                                        <option selected disabled> Select</option>
                                        @foreach ($country as $item)

                                            <option value="{{ $item->id }}">{{$item->country_name}}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="profile" class="form-label">Profile</label><br>
                                    <input type="file" class="form-control-file" name="profile" id="profile">
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <input type="submit" name="regist" id="regist" value="Register"
                                    class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection