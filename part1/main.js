$(document).ready(function() {
	MaterializeCollectionActions.configureActions($('#collection-id'), [
		{
			name: 'delete',
			callback: function (collectionItem, collection) {
				var bmurl = collectionItem.href;
				$.ajax({
					data: 'url=' + bmurl,
					url: 'server/deletebookmark.php',
					method: 'POST',
					success: function(msg) {
					}
				});
				$(collectionItem).remove();
			}
		},
		{
			name: 'mode_edit',
			callback: function (collectionItem, collection) {
				var newurl = prompt("Enter a new URL", collectionItem.href);
				if (newurl != null) {
					if(!isValidURL(newurl)) {
						alert("New URL given is invalid");
					} else {
						$.ajax({
							data: {oldurl: collectionItem.href, newurl: newurl},
							url: 'server/editbookmark.php',
							method: 'POST',
							success: function(msg) {
								location.reload();
							}
						});
					}
				}
			}
		}
	]);
});

function isValidURL(str) {
   var a  = document.createElement('a');
   a.href = str;
   return (a.host && a.host != window.location.host);
}

function validateURL() {
	var url = document.forms["bookmarkform"]["url"].value;
    if (url == "") {
        alert("URL is empty");
        return false;
	}
	else if (!isValidURL(url)) {
		alert("URL given is invalid");
		return false;
	}
}


