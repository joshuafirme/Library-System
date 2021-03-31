$(document).ready(function()
{

    fetchBooks();

    function fetchBooks(){
        $('#book-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/book-maintenance",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'copies', name: 'copies'},
            {data: 'date_acq', name: 'date_acq'},
            {data: 'date_published', name: 'date_published'},
            {data: 'action', name: 'action', orderable:false},
           ]

          });
    
       }

       fetchWeedBooks();

       function fetchWeedBooks(){
           $('#weed-table').DataTable({
           
              processing: true,
              serverSide: true,
             
              ajax:"/weed-maintenance",
                  
              columns:[       
               {data: 'accession_no', name: 'accession_no'},
               {data: 'title', name: 'title'},
               {data: 'author', name: 'author'},
               {data: 'publisher', name: 'publisher'},
               {data: 'category', name: 'category'},
               {data: 'classification', name: 'classification'},
               {data: 'edition', name: 'edition'},
               {data: 'copies', name: 'copies'},
               {data: 'date_acq', name: 'date_acq'},
               {data: 'date_published', name: 'date_published'},
               {data: 'action', name: 'action',orderable:false},
              ]
   
             });
       
          }

       $(document).on('click', '#btn-add-book', function()
       {     
            getAccessionNo();
       });
       
       function getAccessionNo()
       {
           $.ajax({
               url:"/getAccessionNo_ajax",
               type:"GET",
         
               success:function(data){
              //  $('input[name=accession_no]').val(data);
               }
              });
       }

       $(document).on('click', '#btn-view-book', function()
       {     
           let id = $(this).attr('book-id');
           getBookDetails(id);
       });


       $(document).on('click', '#btn-edit-book', function()
       {     
           let id = $(this).attr('book-id');
           getBookDetails(id);
       });

       $(document).on('click', '#btn-weed-book', function()
       {     
           let id = $(this).attr('book-id');
           $('#id_weed').val(id);
       });

       $(document).on('click', '#btn-retrieve-book', function()
       {     
           let id = $(this).attr('book-id');
           $('#id_retrieve').val(id);
       });
   
       function getBookDetails(id)
       {
           $.ajax({
               url:"/book-details/"+id,
               type:"GET",
         
               success:function(data){
                   console.log(data);

                // editing
                 $('#id_hidden').val(id);
                 $('#accession_no').val(data[0].accession_no);
                 $('#title').val(data[0].title);
                 $('#author').val(data[0].author);
                
                 $('#edit_category').append('<option selected value="' + data[0].category + '">' + data[0].category + '</option>');
                 $('#edit_classification').append('<option selected value="' + data[0].classification + '">' + data[0].classification + '</option>');

                 $('#publisher').val(data[0].publisher);
                 $('#edition').val(data[0].edition);
                 $('#no_of_pages').val(data[0].no_of_pages);
                 $('#copies').val(data[0].copies);
                 $('#amount_if_lost').val(data[0].amount_if_lost);
                 $('#cost').val(data[0].cost);
                 $('#date_acq').val(data[0].date_acq);
                 $('#date_published').val(data[0].date_published);
                
                 // viewing
                 $('a[name="accession_no"]').text(data[0].accession_no);
                 $('a[name="title"]').text(data[0].title);
                 $('a[name="author"]').text(data[0].author);
                
                 $('a[name="category"]').text(data[0].category);
                 $('a[name="classification"]').text(data[0].classification);

                 $('a[name="publisher"]').text(data[0].publisher);
                 $('a[name="edition"').text(data[0].edition);
                 $('a[name="no_of_pages"]').text(data[0].no_of_pages);
                 $('a[name="copies"]').text(data[0].copies);
                 $('a[name="amount_if_lost"]').text(data[0].amount_if_lost);
                 $('a[name="cost"]').text(data[0].cost);
                 $('a[name="date_acq"]').text(data[0].date_acq);
                 $('a[name="date_published"]').text(data[0].date_published);
               }
              });
       }

      
    $(document).on('click', '#btn-edit-category', function()
    {     
        let id = $(this).attr('category-id');
        getCat(id);
    });

    function getCat(id)
    {
        $.ajax({
            url:"/category-maintenance/get-cat/"+id,
            type:"GET",
      
            success:function(data){
                console.log(data);
              $('#id_hidden').val(id);
              $('#category').val(data[0].category);
              $('#classification').val(data[0].classification);
            }
           });
    }


    let category = $('#category').find("option:selected").text();
    getClassification(category);

    $(document).on('change', '#category', function()
    {     
        let category = $(this).find("option:selected").text();
        getClassification(category);
    });

    function getClassification(category)
    {
        $.ajax({
            url:"/get-classification/"+category,
            type:"GET",
      
            success:function(data){
                $('#classification').empty();
                $('#edit_classification').empty();
                for (var i = 0; i < data.length; i++) 
                {
                    $('#classification').append('<option value="' + data[i].classification + '">' + data[i].classification + '</option>');
                    $('#edit_classification').append('<option value="' + data[i].classification + '">' + data[i].classification + '</option>');
                }
            }
           });
    }

    let edit_category = $('#edit_category').find("option:selected").text();
    getClassification(edit_category);

    $(document).on('change', '#edit_category', function()
    {     
        let category = $(this).find("option:selected").text();
        getClassification(category);
    });

});