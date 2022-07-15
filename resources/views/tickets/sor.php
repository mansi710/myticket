
    public function search()
    {
        $where=[];
        $where_clause='';
        $search_id=$_GET['searchId'];
        $search_name=$_GET['searchName'];
        $search_status=$_GET['searchStatus'];
        $search_priority=$_GET['searchPriority'];
        $search_message=$_GET['searchMessage'];
        
        // if($tickets = "")
        // {
        //     $tickets=Ticket::where('id','=',$search_id)
        //     ->where('ticket_name','LIKE','%'.$search_name.'%')
        //     ->where('status','=',$search_status)
        //     ->where('priority','=',$search_priority)
        //     ->where('ticket_message','LIKE','%'.$search_message.'%')
        //     ->paginate(5);
        // }
        // else
        // {
        //     $tickets =Ticket::sortable()->paginate(5);
        // }
        
          
        if($search_id)
        {
        
        
            // $where[] = "price LIKE ".$filter_value3."%"; //same here also like id

            $where[] = "id = '$search_id' ";
        
        }
        if($search_name)
        {

            // $where[] = "id LIKE ".$filter_value1."%"; //This is wrong, Id is always exact match so no like will come only = will come
            // $where[] = "id LIKE '%$filter_value1%' "; it is used as like if we enter id=1 then it will 
            // find 1 and 11 also 
           
            // $where[] = "name LIKE ".$filter_value2."%";
            $where[] = "ticket_name LIKE '$search_name'";
        }
        if($search_status)
        {
        
        
            // $where[] = "price LIKE ".$filter_value3."%"; //same here also like id

            $where[] = "status = '$search_status' ";
        
        }
        if($search_priority)
        {
        
            // $where[] = "quantity LIKE ".$filter_value4."%"; //same here also like id
            $where[] = "priority = '$search_priority' ";
        
        }
        
        if($search_message)
        {
        
            // $where[] = "quantity LIKE ".$filter_value4."%"; //same here also like id
            $where[] = "ticket_message LIKE '$search_message' ";
        
        }

        // $fetchAllRecord="select * from productsNew ".$where_clasuse;
        //Check if array is not empty then only give where condition else not
        if(!empty($where)){
            $where_clause = ' WHERE '.implode(' AND ', $where);
            // print_r($where_clause);
            // exit;
        }
        
       

        return view('search',compact('tickets'));
    }
