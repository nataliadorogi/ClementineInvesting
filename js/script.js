var messages;

var refreshMessage = window.setInterval(refreshMessages, 3000);

function refreshMessages(GroupID) {
	$.post( "../updateMessages.php", { Group: GroupID }).done(function(data) {
	    console.log( "Data Loaded: " + data );
	  });
}