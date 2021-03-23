$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });  

    fetchVisitorsLog();

    function fetchVisitorsLog(){
        $('#visitors-log-table').DataTable({

            bPaginate: false,
 
            ajax: '/path/to/script',
            scrollY: 380,
            scroller: {
                loadingIndicator: true
            },

           bFilter: false, bInfo: false,
           processing: true,
           serverSide: true,
          
           ajax:"/visitors-log",
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'grade', name: 'grade'},
            {data: 'created_at', name: 'created_at'},
            {data: 'in_out', name: 'in_out'},
           ]

          });
    
       }

       $(document).on('click', '#btn_in', function()
       {     
            let user_id = $('#user_id').val();
            visitorIn(user_id);
       });    

       function visitorIn(user_id)
       {
           $.ajax({
               url:"/visitors-log/do-in/"+user_id,
               type:"POST",
         
               success:function(response){
                    if(response=='0'){
                        alert('Invalid User ID!');
                    }
                    console.log(response);
                    $('#visitors-log-table').DataTable().ajax.reload();
                    
               }
              });
       }

       $(document).on('click', '#btn_out', function()
       {     
            let user_id = $('#user_id').val();
            visitorOut(user_id);
       });    

       function visitorOut(user_id)
       {
           $.ajax({
               url:"/visitors-log/do-out/"+user_id,
               type:"POST",
         
               success:function(response){
                    if(response=='0'){
                        alert('Invalid User ID!');
                    }
                    console.log(response);
                    $('#visitors-log-table').DataTable().ajax.reload();
                    
               }
              });
       }

});