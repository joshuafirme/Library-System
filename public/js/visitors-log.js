$(document).ready(function()
{
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });  

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchVisitorsLogAdmin(date_from, date_to);
    }  

    function fetchVisitorsLogAdmin(date_from, date_to){
        $('#visitors-log-admin-table').DataTable({
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/visitors-log-admin",
            data:{
                date_from:date_from,
                date_to:date_to
            },
           }, 
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'grade', name: 'grade'},
            {data: 'created_at', name: 'created_at'},
            {data: 'in_out', name: 'in_out'},
           ]

          });
    
       }

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#visitors-log-admin-table').DataTable().destroy();
           fetchVisitorsLogAdmin(date_from, date_to);
       });
    
      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#visitors-log-admin-table').DataTable().destroy();
         fetchVisitorsLogAdmin(date_from, date_to);
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
            if(user_id){
                visitorIn(user_id);
                $('#user_id').val('');
            }else{
                alert('please enter user id');
            }
       });    

       function visitorIn(user_id)
       {
           $.ajax({
               url:"/visitors-log/do-in/"+user_id,
               type:"POST",
         
               success:function(response){
                    if(response=='0'){
                        alert('Invalid User ID!');
                        $('#user_id').val('');
                    }
                    console.log(response);
                    $('#visitors-log-table').DataTable().ajax.reload();
                    
               }
              });
       }

       $(document).on('click', '#btn_out', function()
       {     
            let user_id = $('#user_id').val();
            if(user_id){
                visitorOut(user_id); 
                $('#user_id').val('');
            }else{
                alert('please enter user id');
            }

       });    

       function visitorOut(user_id)
       {
           $.ajax({
               url:"/visitors-log/do-out/"+user_id,
               type:"POST",
         
               success:function(response){
                    if(response=='0'){
                        alert('Invalid User ID!');
                        $('#user_id').val('');
                    }
                    console.log(response);
                    $('#visitors-log-table').DataTable().ajax.reload();
                    
               }
              });
       }

});