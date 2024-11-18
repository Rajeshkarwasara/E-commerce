@extends('layout_user')
@section("content")

<div class="container h-100" style="margin: 7% 0% 7% 7%;">
<a href="{{route('index')}}"><i class="fa-solid fa-circle-arrow-left"></i></a>
    <!-- Account page navigation-->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">
                    <h5>Profile Picture</h5>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('profiles/' . $data->profile) }}"
                        alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <form method="POST" action="{{route("image_update")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="file" class="form-control" id="profile" name="profile"
                                    placeholder="profile">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="submit" name="update" id="update" value="Update Profile Image"
                                    class="btn btn-outline-primary">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Account Details</h5>
                </div>
                @if (session('Account_Details'))
                    <div class="alert alert-success">
                        {{ session('Account_Details') }}
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{route("user_detail_update")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Meet"
                                    value="{{$data->fname}}" required="">
                            </div>
                            <div class="col">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Shah"
                                    value="{{$data->lname}}" required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" required="" value="{{$data->email}}">
                            </div>
                            <div class="col">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="" placeholder="1234567890"
                                    required="" value="{{$data->contact}}">
                            </div>


                            <!-- <div class="col">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" aria-label="Default select example" required=""
                                    name="country">
                                    <option selected disabled> Select</option>
                                    @foreach ($country as $item)
                                      
                                        <option value="{{ $item->id }}">{{$item->country_name}}</option>
                                    @endforeach


                                </select>
                            </div> -->
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="gender" class="form-label">Gender</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                        value="Male" {{ old('gender', $data->gender) == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">
                                        Male
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                        value="Female" {{ old('gender', Auth::user()->gender) == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">
                                        Female
                                    </label>
                                </div>

                            </div>
                            <div class="col">
                                <label for="inputCountry" class="form-label">Country</label>
                                <select class="form-select" id="inputCountry" aria-label="Default select example"
                                    name="country" required>
                                    <option selected disabled>Select</option>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}" {{ $data->country == $item->id ? 'selected' : '' }}>
                                            {{ $item->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" name="address"
                                    placeholder="address" required="">{{$data->address}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="update" id="update" value="Update Profile"
                                class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Orders Section -->
    <div class="row">
        <div class="col-xl">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">
                    <h5>My Orders</h5>
                </div>
                <div class="card-body text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Shipping Charge</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">1</td>
                                <td>Titan Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Delivered</td>
                            </tr>
                            <tr>
                                <td scope="row">2</td>
                                <td>Police Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Attempted Delivery</td>
                            </tr>
                            <tr>
                                <td scope="row">3</td>
                                <td>Rolex Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Confirmed</td>
                            </tr>
                            <tr>
                                <td scope="row">4</td>
                                <td>Tag Heuer Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>Out for delivery</td>
                            </tr>
                            <tr>
                                <td scope="row">5</td>
                                <td>Titan Watch</td>
                                <td>17-02-2022</td>
                                <td>₹1000</td>
                                <td>₹00</td>
                                <td>5</td>
                                <td>₹5000</td>
                                <td>On its way</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection