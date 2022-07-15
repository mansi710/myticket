@extends('layouts.header')
@section('content')
       
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-md-8 mt-5 mb-50">

                            <div class="card text-center">

                                <div class="card-header">Tickets Raised</div>
                                <div class="card-body">

                                <!-- IF ANY ERROR OCCURED IT WILL RETURN ERROR MESSAGE TO USER ON THE FRONT VIEW  -->

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong>There were some problem with your input<br><br>

                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <!-- IF TICKET ADDED SUCCESFULLY IT WILL RETURN SUCCESS MESSAGE TO USER ON THE FRONT VIEW -->
                                @if($message=Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{$message}}</p>
                                    </div>
                                @endif

                                
                                <!-- ADD VALUE AND THEN IF USER CLICKS ON CREATE TICKET IT WILL STORE INTO DATABASE. -->
                                    <form action="{{ route('tickets.store') }}" method="post">
                                        @csrf 

                                        <div class="form-group row">
                                            <label for="ticket_name" class="col-md-4 col-form-label text-md-right">Enter Ticket Name</label>
                                            <div class="col-md-6">
                                                <input id="ticket_name" type="text" class="form-control" name="ticket_name" autocomplete="current-password">
                                            </div>
                                        </div>

                                    
                                        
                                        <div class="form-group row mt-5">
                                            <label for="ticket_prority" class="col-md-4 col-form-label text-md-right">Enter Ticket Prority</label>
                                            <div class="col-md-6">
                                                <select id="priority" type="" class="form-control" name="priority">
                                                    <option value="">Select Priority</option>
                                                    <option value="low">Low</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="high">High</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mt-5">
                                            <label for="ticket_message" class="col-md-4 col-form-label text-md-right">Enter Ticket Message</label>
                                            <div class="form-outline col-md-6">
                                                <textarea class="form-control" name="ticket_message" id="textAreaExample1" rows="4"></textarea>
                                
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0 mt-5" >
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                Create Ticket
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
                <br><br>
    
@endsection
    
