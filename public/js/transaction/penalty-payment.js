$(document).ready(function()
{

    fetchPenaltyList();

    function fetchPenaltyList(){
        $('#penalty-payment-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/penalty-payment",
               
           columns:[      
            {data: 'user_id', name: 'user_id'}, 
            {data: 'name', name: 'name'}, 
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'due_date', name: 'due_date'},
            {data: 'remarks', name: 'remarks', orderable:false},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }



      

});