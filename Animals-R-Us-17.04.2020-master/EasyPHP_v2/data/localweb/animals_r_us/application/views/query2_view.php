<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1, h2 { text-align: center; font-family: Calibri; }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th { border : 1px solid grey; padding: 5px 15px 2px 7px;}
		table.mytable bgcolor {#00FF00;}
		body
		{
 background-color: #C6FFCD;
 
}	
thead th {
    background-color: #006DCC;
    color: white;
}
tbody td {
    background-color: #EEEEEE;
}
	</style>  
</head>
<body>

<h1>Queries</h1>
<div align='center'>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query1')?>'">Number of Animals with Condition</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query2')?>'">Number of lessons by Trainee</button>
	<button type="submit" onclick="location.href='<?php echo site_url('main/query3')?>'">Errors in database</button>
</div>
<h2>Lessons complete by Trainee</h2>
<div align='center'>
<?php
	$tmpl = array ('table_open' => '<table class="mytable">');
	$this->table->set_template($tmpl); 
	
	$this->db->query('drop table if exists temp');
	$this->db->query('create temporary table temp as (SELECT CONCAT(t.Given_Name, " ",t.Family_Name)AS "Trainee Name", 
	count(l.Trainee_ID)  AS "Number of Lessons Booked" 
	FROM Trainee t 
	JOIN traineesInLesson L ON (t.trainee_ID = l.trainee_ID)
	GROUP BY l.Trainee_ID 
	ORDER BY COUNT(l.Trainee_ID) DESC)');
	$query = $this->db->query('select * from temp;');
	echo $this->table->generate($query);
?>
</div>
</body>
</html>