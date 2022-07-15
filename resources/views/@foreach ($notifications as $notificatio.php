@foreach ($notifications as $notificationData)

<tr>

    <td>{{$notificationData->type}}</td>
    <td>{{$notificationData->data}}</td>
    
   
    
</tr>
@endforeach

 <!-- dump($obj);
                                                            dump($obj,$obj->message);
                                                             dump($message);