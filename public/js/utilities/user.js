$(document).ready(function()
{

    fetchUsers();

    function fetchUsers(){
        $('#user-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/user-maintenance",
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }

       $('#user_type').change(function(){
            let user_type = $(this).val();
            if(user_type == 0) {
                $('#grade').attr('readonly', true);
                $('#department').attr('readonly', true);         
            }
            else if(user_type == 1){
                $('#department').attr('readonly', false);
                $('#grade').attr('readonly', true);
            }
            else if(user_type == 2){
                $('#grade').attr('readonly', false);
                $('#department').attr('readonly', true);
            }
       });

       fetchStudents();

       function fetchStudents(){
           $('#student-table').DataTable({
           
              processing: true,
              serverSide: true,
             
              ajax:"/display-student",
                  
              columns:[       
               {data: 'user_id', name: 'user_id'},
               {data: 'name', name: 'name'},
               {data: 'grade', name: 'grade'},
               {data: 'contact_no', name: 'contact_no'},
               {data: 'address', name: 'address'},
               {data: 'action', name: 'action', orderable:false}
              ]
   
             });
       
          }

});