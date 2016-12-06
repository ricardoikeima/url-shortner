<?php
	include_once '../../_admin/config.php';
?>

<?php
	include ('../header.php');
?>

<?php
    include ('../nav.php');
?>
<div id="content">
    <div id="filter">
        <form method="POST" action="../_controller/reportController.php">
            <span id="region"></span>
            From: <input id="startDate" type="date" name="startDate">
            To: <input id="endDate" type="date" name="endDate">
            <input type='submit' value='Filter' onclick="filter(document.getElementById('country').value, document.getElementById('city').value, document.getElementById('startDate').value,document.getElementById('endDate').value);">
        </form>
    </div>
    <span id="report"></span>
</div>

<script>

// Populate Country according to Database
window.addEventListener("DOMContentLoaded", function() {
    // Prevent form to be sent
    event.preventDefault();
    var http = new XMLHttpRequest();
    http.open("POST", "../_controller/formController.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("region").innerHTML = http.responseText;
        }
    };
    http.send();
}, false);

// Update Cities when country is selected
function updateCity(country){
    // Prevent form to be sent
    event.preventDefault();
    var http = new XMLHttpRequest();
    var param = "country=" + country;
    http.open("POST", "../_controller/formController.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("city").innerHTML = http.responseText;
        }
    };
    http.send(param);
}

// Update the report according to the Countrym City and period selected
function filter(country, city, startDate, endDate) {
    // Prevent form to be sent
    event.preventDefault();
    var http = new XMLHttpRequest();
    var param = "country=" + country + "&city=" + city + "&startDate=" + startDate + "&endDate=" + endDate;
    http.open("POST", "../_controller/reportController.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("report").innerHTML = http.responseText;
        }
    };
    http.send(param);
}

</script>
<?php
	include ('../footer.php');
?>	