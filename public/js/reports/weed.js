$(document).ready(function(){

    fetchWeedBooks();

    function fetchWeedBooks(){
        $('#weed-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/weed-report",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'publisher', name: 'publisher'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'copies', name: 'copies'},
            {data: 'updated_at', name: 'updated_at'},
           ]

          });
    
       }

       $('#btn-weed-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        window.open('/weed-report/print/'+date_from+'/'+date_to, '_blank'); 
         
      });

});