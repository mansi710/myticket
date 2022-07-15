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
                            <h2>NOTIFICATION LIST</h2>
                         </div>
                     
                         <!--  List Of Tickets Which Was added by User -->
                         <table class="table table-striped mt-20">
                         <thead class="thead-dark">
                              <tr>
                                   
                                  
                                   <th>Notification Message</th>
                                   <th>ACTION</th>
                              </tr>
                         </thead>
                        <tbody>
                            <!-- fetch all data through foreach if notification table have > 0 record then only display -->

                              @if(count($notifications)>0)
                            
                                   @foreach($notifications as $notificationData)
                                        <tr>

                                      
                                             </td>
                                                  @php
                                                       $obj=json_decode($notificationData->data);  
                                                       $message=$obj->message;  
                                                   
                                                   @endphp
                                             <td>
                                                  {{$message}}
                                               
                                             </td>
                                             <td>
                                                  <a href="{{route('markAsRead',$notificationData->id)}}">Marked As Read</a>
                                             </td>
                                        </tr>
                                   @endforeach
                              @else
                                   <p>No Data Found</p>
                              @endif

                              <!-- ending fetching data logic -->
                            </tbody>
                        </table>    
                         
                    </div>
               </div>
           </div>
     </div>
 @endsection

