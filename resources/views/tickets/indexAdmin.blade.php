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
                        <h2>TICKETS LIST</h2>
                    </div>
                    <!-- if logged in user is user role than also generate tickets -->
             

                    <!-- serching functionality -->
                    
                    <div class="row pull-right mt-40 ">
                        <div class="col-lg-12 margin-tb">
                            <div class="">
                                <form action="{{route('adminTicketList')}}" method="GET">
                                
                                    
                                    <input type="text" name="searchId" value="{{old('id')}}" placeholder="Serach By Ticket Id" />

                                    <input type="text" name="searchName" value="{{old('ticket_name')}}" placeholder="Serach By Ticket Name" />
                                    <input type="text" name="searchStatus" value="{{old('status')}}" placeholder="Serach By Ticket Status" />
                                    <input type="text" name="searchPriority" value="{{old('priority')}}" placeholder="Serach By Ticket Priority" />
                                    <input type="text" name="searchMessage" value="{{old('ticket_message')}}"placeholder="Serach By Ticket Message" />
                               

                                  
                                            
                                    <button type="submit">Search</button>
                                 </form>
                            </div>
                        </div>
                    </div>
                    <br>
                   
                    
   
                    <!--  List Of Tickets Which Was added by User -->
                    <table class="table table-striped mt-20">
                        <thead class="thead-dark">
                            <tr>
                                <!-- sorting functionality -->
                                <th width="80 px">@sortablelink('id')</th>
                                <th>@sortablelink('user_name')</th>
                                <th>@sortablelink('ticket_name')</th>
                                <th>@sortablelink('status')</th>
                                <th>@sortablelink('priority')</th>
                                <th>@sortablelink('ticket_message')</th>
                                <th>@sortablelink('created_at')</th>
                                <th>@sortablelink('updated_at')</th>
                                <!-- ending sorting functionality -->
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- fetch all data through foreach if tickets table have > 0 record then only display -->
                            @if(count($tickets)>0)
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <th scope="row">{{$ticket->id}}</th>
                                        <td>{{$ticket->user->name}}</td>
                                        <td>{{$ticket->ticket_name}}</td>
                                        <td>{{$ticket->status}}</td>
                                        <td>{{$ticket->priority}}</td>
                                        <td>{{$ticket->ticket_message}}</td>
                                        <td>{{$ticket->created_at}}</td>
                                        <td>{{$ticket->updated_at}}</td>
                                        <td>
                                           <form action="{{route('tickets.destroy',$ticket->id)}}" method="post">
                                                <a class="btn btn-primary" href="{{route('tickets.edit',$ticket->id)}}">Edit</a>
                                                <a class="btn btn-info" href="{{route('tickets.show',$ticket->id)}}">Show</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                                    <!-- ending fetching data logic -->
                            </tbody>
                        </table>
                     </div>
                 </div>
         </div>
</div>	
    
    {{$tickets->links('tickets.pagination')}}
    	
@endsection