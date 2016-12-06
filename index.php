<?php
	include_once (dirname(__FILE__).'/_admin/config.php');
?>

<?php
	include (HOME.'_content/header.php');
?>

<?php
	include (HOME.'_content/nav.php');
?>
<div id="content">
	<form method='POST'>
		<input id='url' type='url' name='url' placeholder="URL (http://example.com)">
		<input type='submit' value='URL Shortner' onclick="sendUrl(document.getElementById('url').value);">
	</form>
	<form method='POST'>
		<div id="key"></div>
	</form>
</div>
<script>
// Get URL and create Short URL
function sendUrl(url) {
	// Prevent form to be sent
	event.preventDefault();
    var http = new XMLHttpRequest();
    var param = "url=" + url;
    http.open("POST", "_content/_controller/urlController.php", true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("key").innerHTML = http.responseText;
        }
    };
   	http.send(param);
}

</script>
<?php
	include (HOME.'_content/footer.php');
?>	