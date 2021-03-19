$(document).ready(function()
{

    fetchBooks();

    function fetchBooks(){
        $('#borrow-book-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/borrow-book",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'copies', name: 'copies'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }


       $(document).on('click', '#btn-borrow-book', function()
       {     
           let id = $(this).attr('book-id');
           getBookDetails(id);
       });
   
       function getBookDetails(id)
       {
           $.ajax({
               url:"/book-details/"+id,
               type:"GET",
         
               success:function(data){
                    console.log(data);
                    $('#id_hidden').val(id);
                    $('input[name=accession_no]').val(data[0].accession_no);
                    $('#accession_no').text(data[0].accession_no);
                    $('#title').text(data[0].title);
               }
              });
       }


       $(document).on('keyup', '#search_borrower', function()
       {     
           let search_key = $(this).val();

           if(search_key)
           {
                searchUser(search_key)
           }else{
                clear();
           }
       });


       function searchUser(search_key){
            $.ajax({
                url:"/search-user/"+search_key,
                type:"GET",
        
                success:function(data){
                    if(data.length > 0){
                        $('#user_id').val(data[0].user_id);
                        $('#name').text(data[0].name);          
                        $('#contact_no').text(data[0].contact_no);
    
                        if(data[0].grade){
                        $('#grade-dept').text(data[0].grade);
                        }
                        else{
                        $('#grade-dept').text(data[0].department);
                        }
                    }
                    else{
                        clear();
                    }
                }
            });
       }

       function clear(){
            $('#user_id').val('');
            $('#name').text('');          
            $('#contact_no').text('');
            $('#grade-dept').text('');
            $('#grade-dept').text('');
       }

});