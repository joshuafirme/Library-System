$(document).ready(function()
{

    fetchBooks();

    function fetchBooks(){
        $('#book-search-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/book-search",
               
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

});