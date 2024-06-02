<html>
	<head>
		<style>
			.box
			{
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				background-color: skyblue;
				width: 50%;
				height: 50%;
				margin: auto;
			}

			table
			{
				margin: 0 auto;
				margin-top: 40px;
				text-align: left;
			}

			.btn_deco
			{
				background-color: #d4d420;
				border: none;
				color: white;
				text-align: center;
				font-size: 12px;
				font-family: sans-serif;
				cursor: pointer;
				margin-bottom: 3%;
				padding: 5px;
				border-radius: 4px;
				width: 100%;
			}
		</style>
		<title>Booking Ticket</title>
	</head>

	<body>
		<div class= "box">
			<?php
			$page_title = 'Ticket Bus Online';
			include('./includes/header.html');
			?>
		<form action= "handle_bus_ticket.php" method= "post">

			<h1>Ticket Bus</h1>
			<h2>Book your online Bus Ticket Now!!</h2>

			<fieldset>
		<table>
			<tr>
				<td><b>Name: </b></td>
				<td><input type="text" name="name" size="50%" maxlength="40" /></td>	
			</tr>

			<tr>
				<td><b>Bus: </b></td>
				<td>
					<?php
					// This script make a pull-down menus for an HTML form: months.
					// The programme is display in an array.
					$bus = array (1 => 'Pick your Bus', 'MYXPRESS', 'EMutiara', 'Sani Express', 'Queen Express', 'Perdana Express');
					// the programme is display using the pull-down menu.
					echo '<select name="bus">';
					foreach ($bus as $value){
						echo "<option value=\"$value\">$value</option>\n";
					}
					echo '</select>';
					?>
				</td>
			</tr>

			<tr>
				<td><b>Departure Day: </b></td>
				<td>
					<?php
					// This script make a pull-down menus for an HTML form: months.
					// The programme is display in an array.
					$day = array (1 => 'Pick your Day', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
					// the programme is display using the pull-down menu.
					echo '<select name="day">';
					foreach ($day as $value){
						echo "<option value=\"$value\">$value</option>\n";
					}
					echo '</select>';
					?>
				</td>
			</tr>

			<tr>
				<td><b>Departure time: </b></td>
				<td><?php
					// This script make a pull-down menus for an HTML form: months.
					// The programme is display in an array.
					$time = array (1 => 'Pick your time', '7:00', '10:00', '13:00', '16:00', '21:00');
					// the programme is display using the pull-down menu.
					echo '<select name="time">';
					foreach ($time as $value){
						echo "<option value=\"$value\">$value</option>\n";
					}
					echo '</select>';
					?>		
				</td>
			</tr>

			<tr>
			<td>&nbsp; </td>
				<td>
					<input type="submit" name="btn_select" value="Select" class="btn_deco">
				</td>
			</tr>
		</table>
			</fieldset>
		</form>
		<?php
			include('./includes/footer.html');
		?>
	</body>

</html>

