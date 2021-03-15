$(document).ready(function()
{

    fetchData();

    function fetchData(){
        $('#book-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/book-maintenance",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'editiono'},
            {data: 'no_of_pages', name: 'no_of_pages'},
            {data: 'amount_if_lost', name: 'amount_if_lost'},
            {data: 'cost', name: 'cost'},
            {data: 'date_acq', name: 'date_acq'},
            {data: 'date_published', name: 'date_published'},
            {data: 'action', name: 'action', orderable:false},
           ]

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
                for (var i = 0; i < data.length; i++) 
                {
                    $('#classification').append('<option value="' + data[i].id + '">' + data[i].classification + '</option>');
                }
            }
           });
    }

});