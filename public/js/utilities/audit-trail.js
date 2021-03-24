$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchAuditTrail(date_from, date_to);
    }  

    function fetchAuditTrail(date_from, date_to){
        $('#audit-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/audit-trail",
            data:{
                date_from:date_from,
                date_to:date_to
            },
           }, 
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'user_type', name: 'user_type'},
            {data: 'module', name: 'module'},
            {data: 'action', name: 'action', orderable:false},
            {data: 'created_at', name: 'created_at'},
           ]

          });
    
       }

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#audit-table').DataTable().destroy();
           fetchAuditTrail(date_from, date_to);
       });
    
      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#audit-table').DataTable().destroy();
         fetchAuditTrail(date_from, date_to);
      });
});