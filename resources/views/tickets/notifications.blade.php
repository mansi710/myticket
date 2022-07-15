<div id="unreadNotifications">

    dd{{$notifications}}
    @foreach (notifications as $notification)
                            
        <div class="main-notification-list Notification-scroll mark-as-read"  >
             <a class="d-flex p-3 border-bottom"
                  href="{{ url('InvoicesDetails') }}/{{ $notification->data['id'] }}"  data-id="{{$notification->id}}" >
                                    
                    <div class="notifyimg ">
                         <i class="la la-file-alt text-pink text-center"></i>
                    </div>
                    <div class="ml-3">
                        <h5 class="notification-label mb-1">
                             {{ $notification->data['type'] }}
                               {{ $notification->data['data'] }}
                        </h5>
                        <div class="notification-subtext">{{ $notification->created_at }}
                        </div>
                    </div>
                                      
             </a>
           </div>
        @endforeach

 </div>
