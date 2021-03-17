// ================* MOTHLY *
function submitDate() {
    let daterange = $('#daterange').val();
    let date = $('#date').val()
    if (daterange == 'day' || daterange == 'minute') {
         date = $('#date').val()
    } else if (daterange == 'month') {
         date = $('#month').val()
    } else if (daterange == 'year') {
         date = $('#year').val()
    }
    $('#status').html('<span class="tx-12 align-self-center badge badge-warning">Loading ...</span>')
   
}
 