<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use App\Notifications\CommentCreatedNotification;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Comment $comment,Request $request,Ticket $tickets)
    {
        $comment=Comment::with('getTicket')->where('user_id',"=",Auth::user()->id)->get();
        

        // return view('product.list',compact('data'));

        // //
        //  Comment::where('user_id',"=",Auth::user()->id)->paginate(3);
        
       
        //  return redirect()->route('tickets.show')->with('success','Comment Added Successfully.');
        // return redirect()->back()->withInput('comments');
        // dd( redirect()->back()->with(compact('comments')));

        return redirect()->back()->with('success','Comment Added Successfully.');;


    }

  
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Comment $comment,Ticket $ticket)
    {
        //
        // dump($request);
        // $request->validate([
        //     'comment'=>'required'
          
        // ]);

        // Comment::create($request->all());
       
    //    $comment=new comment;
    //    $comment->ticket_id=$request->get('ticket_id');
    //    $comment->user_id=Auth::user()->id;
    //    $comment->comment_name=$request->comment_name;
    //    $comment->save();

     
        
        $this->validate($request, [
            'comment_name' => 'required'
        ]);
        $comment = Comment::create([
            'ticket_id'=>$request->get('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment_name' => $request->input('comment_name')
        ]);


        $comment->save();
        $comment->notify(new CommentCreatedNotification($comment));
        


        return redirect()->route('comments.index')->with('success','Comment Added Successfully.');

     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
