$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchReturnedBooks(date_from, date_to);
    }  

    function fetchReturnedBooks(date_from, date_to){
        console.log(date_from+' asfd');
        console.log(date_to+' dsada');
        $('#returned-report-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/returned-report",
            data:{
                date_from:date_from,
                date_to:date_to
            },
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

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#returned-report-table').DataTable().destroy();
           fetchReturnedBooks(date_from, date_to);
       });
    
      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#returned-report-table').DataTable().destroy();
         fetchReturnedBooks(date_from, date_to);
      });

      $('#btn-returned-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        window.open('/returned-report/print/'+date_from+'/'+date_to, '_blank'); 
         
      });
        
});