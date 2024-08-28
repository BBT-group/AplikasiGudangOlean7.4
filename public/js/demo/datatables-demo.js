// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('#dataTables').DataTable({
    "searching": false,
    "paginate": true,
    "sort": true
  });
  $('#dataTabless').DataTable({
    "searching": false,
    "paginate": false,
    "sort": false
  });
});
