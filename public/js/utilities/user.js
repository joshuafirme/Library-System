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

       $('#edit_user_type').change(function(){
            let user_type = $(this).val();
            if(user_type == 0) {
                $('#edit_grade').attr('readonly', true);
                $('#edit_department').attr('readonly', true);         
            }
            else if(user_type == 1){
                $('#edit_department').attr('readonly', false);
                $('#edit_grade').attr('readonly', true);
            }
            else if(user_type == 2){
                $('#edit_grade').attr('readonly', false);
                $('#edit_department').attr('readonly', true);
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

        fetchTeacher();

        function fetchTeacher(){
            $('#teacher-table').DataTable({
            
                processing: true,
                serverSide: true,
                
                ajax:"/display-teacher",
                    
                columns:[       
                {data: 'user_id', name: 'user_id'},
                {data: 'name', name: 'name'},
                {data: 'department', name: 'department'},
                {data: 'contact_no', name: 'contact_no'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action', orderable:false}
                ]
    
                });
        
        }


        // show user details
        $(document).on('click', '#btn-edit-user', function()
        {     
            let user_id = $(this).attr('user-id');
            let user_type = $(this).attr('user-type');

            if(user_type == 2)
            {
                $('#edit_grade').attr('readonly', false);
                $('#edit_department').attr('readonly', true);
                getStudentDetails(user_id);
            }
        });
    
        function getStudentDetails(user_id)
        {
            $.ajax({
                url:"/student-details/"+user_id,
                type:"GET",
          
                success:function(data){
                    console.log(data);
                    $('#user_id_hidden').val(user_id);
                    $('#name').val(data[0].name);
                    $('#edit_grade').val(data[0].grade);
                    $('#contact_no').val(data[0].contact_no);
                    $('#address').val(data[0].address);
                    $('#user_id').val(data[0].user_id);
                }
               });
        }

        $(document).on('click', '#btn-archive-user', function()
        {     
            let id = $(this).attr('user-id');
            console.log(id);
            $('#id_archive').val(id);
        });
 

});