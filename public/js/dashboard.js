$(document).ready(function()
{
    

    fetchBorrowedBooks();

    function fetchBorrowedBooks(){
        $('#borrowed-table').DataTable({

           processing: true,
           serverSide: true,
          
           ajax:"/display-borrowed",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'status', name: 'status'}
           ]
        });
    
    }

    
    fetchReservedBooks();

    function fetchReservedBooks(){
        $('#reserved-table').DataTable({

        
           processing: true,
           serverSide: true,
          
           ajax:"/display-reserved",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'status', name: 'status'}
           ]
        });
    }
});