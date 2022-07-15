@extends('layouts.header')
@section('content')
   
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-50">
                            <h2>PROFILE</h2>
                        </div>

                        <!-- show the detail of specific ticket -->
                        <div class="col-md-12 text-center mt-5">
                            <div class="form-group row col-md-12">
                                <label for="uuser_name" class="col-md-6 col-form-label text-md">
                                     Name</label>
                                <div class="col-md-6">
                                        {{Auth::user()->name}}
                                    </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="user_email" class="col-md-6 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                {{Auth::user()->email}}
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                            <label for="user_role" class="col-md-6 col-form-label text-md-right">Role</label>
                                <div class="col-md-6">
                                {{Auth::user()->role}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                
                    
@endsection