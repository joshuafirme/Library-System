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

    fetchPenaltyPaid();

    function fetchPenaltyPaid(){
        $('#penalty-paid-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/penalty-payment-paid",
               
           columns:[      
            {data: 'user_id', name: 'user_id'}, 
            {data: 'name', name: 'name'}, 
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'due_date', name: 'due_date'},
            {data: 'remarks', name: 'remarks', orderable:false}
           ]

          });
    
       }


       $(document).on('click', '#btn-pay', function()
       {   
           let user_id, accession_no; 
   
           user_id = $(this).attr('user-id');
           accession_no = $(this).attr('accession-no');
           
           $('#user_id').val(user_id);
           $('#acn_no').val(accession_no);
           console.log(user_id);
           console.log(accession_no);
       });
      

});