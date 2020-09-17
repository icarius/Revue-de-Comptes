// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.table-bordered').dataTable( {
	"paging": false,
	"processing": true,
  } );
});
