$(document).ready(function()
{  

    load_data();

    function load_data()  {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        fetchVisitorsLog(date_from, date_to);
    }  

    function fetchVisitorsLog(date_from, date_to){
        $('#visitors-log-report-table').DataTable({
           processing: true,
           serverSide: true,
          
           ajax:{
            url: "/visitors-log-report",
            data:{
                date_from:date_from,
                date_to:date_to
            },
           }, 
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'grade', name: 'grade'},
            {data: 'created_at', name: 'created_at'},
            {data: 'in_out', name: 'in_out'},
           ]

          });
    
       }

       $('#date_from').change(function()
       {
           let date_from = $('#date_from').val()
           let date_to = $('#date_to').val();
            console.log(date_from);
            console.log(date_to);
           $('#visitors-log-report-table').DataTable().destroy();
           fetchVisitorsLog(date_from, date_to);
       });
    
      $('#date_to').change(function()
      {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
         console.log(date_from);
         console.log(date_to);
         $('#visitors-log-report-table').DataTable().destroy();
         fetchVisitorsLog(date_from, date_to);
      });

      $('#btn-visitors-log-print').click(function () {
        let date_from = $('#date_from').val()
        let date_to = $('#date_to').val();
        window.open('/visitors-log-report/print/'+date_from+'/'+date_to, '_blank'); 
         
      });
});