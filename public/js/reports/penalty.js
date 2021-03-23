$(document).ready(function()
{

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchPenaltyList(date_from, date_to);
    }  

    function fetchPenaltyList(date_from, date_to){
        $('#penalty-report-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/penalty-report",
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
            {data: 'status', name: 'status'},
           ]

          });
    
       }

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#penalty-report-table').DataTable().destroy();
           fetchPenaltyList(date_from, date_to);
       });
    
      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#penalty-report-table').DataTable().destroy();
         fetchPenaltyList(date_from, date_to);
      });

      $('#btn-penalty-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        window.open('/penalty-report/print/'+date_from+'/'+date_to, '_blank'); 
         
      });
        
});