$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchUnreturnedBooks(date_from, date_to);
    }  

    function fetchUnreturnedBooks(date_from, date_to){
        console.log(date_from+' asfd');
        console.log(date_to+' dsada');
        $('#unreturned-report-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/unreturned-report",
           }, 
               
           columns:[      
            {data: 'user_id', name: 'user_id'}, 
            {data: 'name', name: 'name'}, 
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'due_date', name: 'due_date'},
           ]

          });
    
       }

      $('#btn-unreturned-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        window.open('/unreturned-report/print/'+date_from+'/'+date_to, '_blank'); 
         
      });
        
});