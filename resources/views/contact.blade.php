@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Contact</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ url('list') }}">
                        @csrf
                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="" placeholder="Enter first name" autofocus value="{{ old('firstname') }}">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Enter last name" value="{{ old('lastname') }}">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter phone number" autofocus value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" id="nickname" placeholder="Enter nickname" value="{{ old('nickname') }}">
                                    @error('nickname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company">Company Name</label>
                                <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" id="company" placeholder="Enter company" value="{{ old('company') }}">
                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <textarea class="form-control" rows="4" placeholder="Enter address " name="address"></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="company">Status</label>
                                <div class="">
                                <input id="statusactive" type="radio" @error('status') is-invalid @enderror name="status" autocomplete="new-status" value="Active" checked> <!-- class="form-control"-->
                                <label for="statusactive">Active</label>
                                <input id="statusinactive" type="radio" @error('status') is-invalid @enderror name="status"  autocomplete="new-status" value="Inactive">
                                <label for="statusinactive">Inactive</label>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection