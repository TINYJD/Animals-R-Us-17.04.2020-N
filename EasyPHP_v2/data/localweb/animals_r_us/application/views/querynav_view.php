<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1, h2 { text-align: center; font-family: Calibri; }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;}
		th {background-color: #f2e4d5;}	
		
	</style>
</head>
<body>

<h1>Queries</h1>


<div align='center'>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query1')?>'">Number of Animals with Condition</button>
	
	<button type="submit" onclick="location.href='<?php echo site_url('main/query2')?>'">Number of lessons by Trainee</button>
</div>
</body>
</html>