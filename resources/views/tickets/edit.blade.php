@extends('layouts.header')
@section('content')
    


        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8 mt-5">

                    <div class="card">

                        <div class="card-header">Tickets Update</div>
                        <div class="card-body">

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
                        @if($message=Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif

                        <form action="{{route('tickets.update',$ticket->id)}}" method="post">
                            @csrf
                            @method('PATCH')

                       
                                <div class="form-group row mt-5">
                                    <label for="ticket_name" class="col-md-4 col-form-label text-md-right">Enter Ticket Name</label>
                                    <div class="col-md-6">
                                        <input id="ticket_name" type="text" class="form-control" name="ticket_name" value="{{$ticket->ticket_name}}" autocomplete="current-password">
                                    </div>
                                </div>
                                
                                <div class="form-group row mt-5">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Update Ticket Status</label>
                                    <div class="col-md-6">
                                        <select class="status" name="status">
                                                <option>{{$ticket->status}}</option>
                                                <option value="approve" @if($ticket->status=='approve') selected='selected' @endif>Approve</option>     
                                                <option value="reject" @if($ticket->status=='reject') selected='selected' @endif>Reject</option>   
                                                <option value="inprogress" @if($ticket->status=='inprogress') selected='selected' @endif>Inprogress</option>   
                                                <option value="pending" @if($ticket->status=='pending') selected='selected' @endif>Pending</option>   
                                        </select>

                                    </div>
                                </div>


                                <div class="form-group row mt-5">
                                    <label for="ticket_message" class="col-md-4 col-form-label text-md-right">Enter Ticket Message</label>
                                    <div class="form-outline col-md-6">
                                        <textarea class="form-control" name="ticket_message" id="textAreaExample1" rows="4">{{$ticket->ticket_message}}</textarea>
                        
                                     </div>
                                </div>

                                <div class="form-group row mb-0 mt-5" >
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                          Update Ticket
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


