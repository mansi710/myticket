<table class="table table-striped mt-50">
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>TICKET NAME</th>
                                <th>STATUS</th>
                                <th>PRIORITY</th>
                                <th>TICKET MESSAGE</th>
                                <th>CREATED_AT</th>
                                <th>UPDATED_AT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$ticket->id}}</th>
                                    <td>{{$ticket->ticket_name}}</td>
                                    <td>{{$ticket->status}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>{{$ticket->ticket_message}}</td>
                                    <td>{{$ticket->created_at}}</td>
                                    <td>{{$ticket->updated_at}}</td>
                                    <td>
                                        <form action="{{route('tickets.destroy',$ticket->id)}}" method="post">
                                            <!-- if logged in user as admin then only admin can have right to edit ticket -->
                                            @can('isAdmin',$ticket)        
                                                <a class="btn btn-primary" href="{{route('tickets.edit',$ticket->id)}}">Edit</a>
                                            @endcan
                                                
                                            <a class="btn btn-info" href="{{route('tickets.show',$ticket->id)}}">Show</a>

                                            <!-- if logged in user as admin then only admin can have right to delete ticket -->
                                            @can('isAdmin',$ticket)
                                                @csrf
                                                @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                            @endcan
                                        </form>
                                    </td> 
                                </tr>
                        </tbody>
                    </table>    