$(document).ready(function()
{

    fetchReservationList();

    function fetchReservationList(){
        $('#for-release-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/for-release",
               
           columns:[       
            {data: 'user_id', name: 'user_id'},
            {data: 'name', name: 'name'},
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'reservation_date', name: 'reservation_date'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
    }

    $(document).on('click', '#btn-release', function()
    {   
        let user_id, accession_no; 

        user_id = $(this).attr('user-id');
        accession_no = $(this).attr('accession-no');
        
        $('#user_id').val(user_id);
        $('#acn_no').val(accession_no);
        console.log(user_id);
        console.log(accession_no);
    });


});