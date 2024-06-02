<html>
<head>
	<title>Your selected ticket</title>
</head>
<body>
<?php 

	$page_title = 'Ticket Bus Online';
	include('./includes/header.html');

// Create a shorthand for the form data.
$n = $_POST['name'];
$b = $_POST['bus'];
$d = $_POST['day'];
$t = $_POST['time'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
//define the repayment table using the associative array
        $repaymentTable=array(
            'Saturday_7:00' => 8,
            'Saturday_10:00' => 8,
            'Saturday_13:00' => 8,
            'Saturday_16:00' => 8,
            'Saturday_21:00' => 6,
            'Sunday_7:00' => 8,
            'Sunday_10:00' => 8,
            'Sunday_13:00' => 8,
            'Sunday_16:00' => 8,
            'Sunday_21:00' => 6,
            'Monday_7:00' => 6,
            'Monday_10:00' => 6,
            'Monday_13:00' => 6,
            'Monday_16:00' => 6,
            'Monday_21:00' => 5,
            'Tuesday_7:00' => 6,
            'Tuesday_10:00' => 6,
            'Tuesday_13:00' => 6,
            'Tuesday_16:00' => 6,
            'Tuesday_21:00' => 5,
            'Wednesday_7:00' => 6,
            'Wednesday_10:00' => 6,
            'Wednesday_13:00' => 6,
            'Wednesday_16:00' => 6,
            'Wednesday_21:00' => 5,
            'Thursday_7:00' => 6,
            'Thursday_10:00' => 6,
            'Thursday_13:00' => 6,
            'Thursday_16:00' => 6,
            'Thursday_21:00' => 5,
            'Friday_7:00' => 6,
            'Friday_10:00' => 6,
            'Friday_13:00' => 6,
            'Friday_16:00' => 6,
            'Friday_21:00' => 5,
        );

        $key = "$d" . "_" . "$t";

        if (array_key_exists($key, $repaymentTable)) 
        {	
            echo "<div style='text-align:center; margin-top: 20px; font-family: sans-serif; background-color: skyblue;'>";
            echo "<h2>Your Ticket Selected</h2>";
            echo "<p>Name: $n</p>";
            echo "<p>Bus: $b</p>";
            echo "<p>Departure Day: $d</p>";
            echo "<p>Departure Time: $t</p>";
            echo "<p>Ticket Price: RM" . $repaymentTable[$key] ."</p>";
            echo "</div>";
        } else 
        {
            echo "<div style='text-align:center; margin-top: 20px; color: red; font-family: sans-serif'>";
            echo "<p>Error occured please choose your Departure Day and Departure Time.</p>";
            echo "</div>";
        }
}
	include('./includes/footer.html');
?>
</body>
</html>