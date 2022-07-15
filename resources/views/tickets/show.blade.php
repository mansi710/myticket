@extends('layouts.header')
@section('content')
    
        
        @if($message=Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-50">
                            <h2>DETAIL LIST</h2>
                        </div>

                    <!-- show the detail of specific ticket -->
                    <div class="col-md-12">
                                    <div class="form-group row col-md-12">
                                        <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                            Ticket Name</label>
                                        <div class="col-md-6">
                                            {{$ticket->ticket_name}}
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label for="status" class="col-md-6 col-form-label text-md-right">Ticket Status</label>
                                        <div class="col-md-6">
                                        {{$ticket->status}}
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label for="ticket_message" class="col-md-6 col-form-label text-md-right">Ticket Name</label>
                                        <div class="form-outline col-md-6">
                                           {{$ticket->ticket_message}}
                            
                                        </div>
                                    </div>
                        </div>
                        <!-- details section complete here -->


                        <!-- Comment Section start -->
                        <div class="col-md-12">
                            <!-- To Add Comment Adding Comment Here -->
                            <form action="{{ route('comments.store') }}" method="post">

                                    @csrf 
                                
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center mt-50">
                                                        <h3>COMMENT SECTION</h3>
                                                    </div>
                                                    <div class="form-group row mt-5">
                                                    
                                                        <div class="form-outline col-md-6">
                                                            
                                                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group row mt-5">
                                                        <label for="comment" class="col-md-4 col-form-label text-md-center">Enter Comment</label>
                                                        <div class="form-outline col-md-6">
                                                                <textarea class="form-control" name="comment_name" id="textAreaExample1" rows="4" placeholder="Enter Comment Here"></textarea>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row mb-0 mt-5" >
                                                        <div class="col-md-8 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                Create Comment
                                                            </button>
                                                        </div>
                                                    </div>
                                            
                                        </div>
                                    </div>
                            </form>
                            <!-- End To Add Comment Adding Comment Here -->
                                
                            <div>

                        </div>
                        <!-- Comment Section end -->
                    </div>
                </div>
            </div>
        </div>  

    


        <div class="continer-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p><b>COMMENT LIST</b></p>
                     
                        
                        @foreach($ticket->comments as $comment)
                            <div class="display-comment ">
                          
                            @if($comment->user_id == 1)
                                <div class=" p-5 mt-5 mb-4 bg-success text-white">

                                    <span class="pull-left">{{ $comment->created_at}}</span>
                                    <strong class="pull-right"> {{ $comment->user->role }}
                                        {{ $comment->user->name }}</strong><br>
                            
                                    <p class="pull-right">{{ $comment->comment_name }}</p><br>
                                    
                                </div>
                            @else
                           
                                <div class=" p-5 mt-5 mb-4 bg-secondary text-white">
                                    <span class="pull-right">{{ $comment->created_at }}</span>
                                    <strong class="pull-left">{{ $comment->user->role }}<p> : -
                                {{ $comment->user->name }}</strong><br>
                                    <p class="pull-left">{{ $comment->comment_name }}</p><br>
                                </div>
                            @endif 
                            </div>
                      
                        @endforeach
                        <hr />
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
 @endsection