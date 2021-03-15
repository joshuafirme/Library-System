$(document).ready(function()
{
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
                    $('#classification').append('<option value="' + data[i].classification + '">' + data[i].classification + '</option>');
                }
            }
           });
    }

});