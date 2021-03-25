$(document).ready(function()
{

    fetchReturnedBooks();

    function fetchReturnedBooks(){
        $('#return-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/return-book",
               
           columns:[      
            {data: 'user_id', name: 'user_id'}, 
            {data: 'name', name: 'name'}, 
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'due_date', name: 'due_date'},
            {data: 'status', name: 'status', orderable:false},
            {data: 'is_penalty', name: 'is_penalty', orderable:false},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }


       $(document).on('click', '#btn-return-book', function()
       {     
           let user_id = $(this).attr('user-id');
           let accession_no = $(this).attr('accession-no');
           getBorrowedDetails(user_id, accession_no)
       });
   
       function getBorrowedDetails(user_id, accession_no)
       {
           $.ajax({
               url:" /get-borrowed-details/"+user_id+'/'+accession_no,
               type:"GET",
         
               success:function(data){
                 console.log(data);
                 $('input[name=user_id]').val(data[0].user_id);
                 $('input[name=accession_no]').val(data[0].accession_no);

                 $('#user_id').text(data[0].user_id);
                 $('#name').text(data[0].name);
                 $('#contact_no').text(data[0].contact_no);

                 if(data[0].grade){
                    $('#grade-dept').text(data[0].grade);
                 }else{
                    $('#grade-dept').text(data[0].department);
                 }

                 $('#accession_no').text(data[0].accession_no);
                 $('#title').text(data[0].title);
                 $('#due_date').text(data[0].due_date);
                 
                 if(data[0].is_penalty == 1){
                  $("#remarks option[value=1]").remove();
                    $('#remarks').val(2);
                 }
                 else{
                  $('#remarks').append('<option value="' + 1 + '">Returned</option>');
                  $('#remarks').val(1);
                   /* $('#remarks  option').each(function(){
                     if ($('#remarks').val() == 1) {
                        $('#remarks').append('<option value="' + 1 + '">Returned</option>');
                     }
                   });*/
                 }
               }
              });
       }
      

});