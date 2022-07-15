<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use DB;
use Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $notifications =DB::table('notifications')->get();
        // dump($notifications);
        $users =DB::table('users')->get();
        // dump($users);


        return view('notificationsShow',compact('notifications','users'));


        // $notifications = Notification::get();

        // $notifications->where('user_id', Auth::user()->id);

        // dd($notifications);

            // $user = User::get();
            // dd($user->notification);
           
            // foreach ($user->notifications as $notification) {
            //     echo $notification->type;
            // }
        //  $notification=new Notification();
     
        // return view('notifications',compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        // dd($id);
    
        
        $data=DB::table('notifications')->where('id',$id)->update(['read_at'=>Carbon::now()]);
       
        return redirect()->route('getListOfNotifications')->with('success','Notification Read Successfull');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($notificable_id,User $user,Notification $notifications)
    {
        //
     
        $notifications=$notificable_id;
        dump($notifications);
   
        // dd($data=$notifications->unreadNotifications);
    
        // $dataNew=$data->markAsRead();

        // dd($dataNew);
        // $data= Auth::user()->unreadNotifications;
        // dd($data);
        foreach ($notifications->unreadNotifications as $notification) {
           dd( $notification->markAsRead());
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,User $user, Notification $notifications)
    {
        //

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
