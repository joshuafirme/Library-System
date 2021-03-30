$(document).ready(function()
{

    fetchBooks();

    function fetchBooks(){
        $('#reserve-book-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/reserve-book",
               
           columns:[       
            {data: 'accession_no', name: 'accession_no'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'category', name: 'category'},
            {data: 'classification', name: 'classification'},
            {data: 'edition', name: 'edition'},
            {data: 'copies', name: 'copies'},
            {data: 'action', name: 'action', orderable:false}
           ]

          });
    
       }


       $(document).on('click', '#btn-reserve-book', function()
       {     
           let id = $(this).attr('book-id');
           getBookDetails(id);
       });
   
       function getBookDetails(id)
       {
           $.ajax({
               url:"/book-details/"+id,
               type:"GET",
         
               success:function(data){
                   console.log(data);
                 $('#id_hidden').val(id);
                 $('input[name=accession_no]').val(data[0].accession_no);
                 $('#accession_no').text(data[0].accession_no);
                 $('#title').text(data[0].title);
                 $('#author').text(data[0].author);
                
                 $('#category').text(data[0].category);
                 $('#classification').text(data[0].classification);

                 $('#publisher').text(data[0].publisher);
                 $('#edition').text(data[0].edition);
                 $('#no_of_pages').text(data[0].no_of_pages);
                 $('#copies').text(data[0].copies);
               //  $('#amount_if_lost').text(data[0].amount_if_lost);
               //  $('#cost').text(data[0].cost);
                 $('#date_acq').text(data[0].date_acq);
                 $('#date_published').text(data[0].date_published);
               }
              });
       }


       $(document).on('change', '#reservation_date', function()
       {     
           let res_date = $(this).val();
           if(res_date < getCurrentDate()){
               alert('You cannot reserve that date!');
               $('#reservation_date').val(getCurrentDate());
           }
           else if(getCurrentDatePlusOneWeek() < res_date ){
            alert('You cannot reserve more than 7 days!');
            console.log(getCurrentDatePlusOneWeek());
            $('#reservation_date').val(getCurrentDate());
        }
           
       });

       function getCurrentDate(){
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();
        
        return d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day;
       }

       function getCurrentDatePlusOneWeek(){
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        let next_month_days=0;
        let week_days = 7;
        var days;

        while (day < 31) {   
            day ++;
            week_days--;
            if(day==31)
            {
                days = next_month_days + week_days;
                month++;
            }
            else{
                days = day;
            }
          }
 
        return d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (days<10 ? '0' : '') + days;
       }


       fetchReservationList();

    function fetchReservationList(){
        $('#approve-reservation-table').DataTable({
        
           processing: true,
           serverSide: true,
          
           ajax:"/approve-reservation",
               
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

    $(document).on('click', '#btn-approve', function()
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