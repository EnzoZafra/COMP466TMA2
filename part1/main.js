$(document).ready(function() {
	MaterializeCollectionActions.configureActions($('#collection-id'), [
		{
			name: 'delete',
			callback: function (collectionItem, collection) {
				console.log(collectionItem.href);
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
	]);
});

function isValidURL(str) {
	regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
	if (regexp.test(str))
	{
		return true;
	}
	else
	{
		return false;
	}
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


