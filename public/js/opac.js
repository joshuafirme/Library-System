$(document).ready(function()
{
    

    fetchBooks();

    function fetchBooks(){
        $('#opac-table').DataTable({

            bFilter: false, bInfo: false,
        
           processing: true,
           serverSide: true,
          
           ajax:"/opac",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'copies', name: 'copies'}
           ]

          });
    
       }


       var table = $('#opac-table').DataTable();
       var search_by = $('#search_by').val();

       $('#search_by').on( 'change', function () {
            search_by = $(this).val();
        } );

        $('#search_key').on( 'keyup', function () {
            table
                .columns(search_by)
                .search( this.value )
                .draw();
        } );

});