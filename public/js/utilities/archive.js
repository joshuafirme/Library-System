$(document).ready(function()
{

    fetchUsers();

    function fetchUsers(){
        $('#archive-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/archive",
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'address', name: 'address'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }

       $(document).on('click', '#btn-retrieve-user', function()
       {     
           let id = $(this).attr('user-id');
           $('#id_retrieve').val(id);
       });
});