<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<style>
		h1, h2, h3 ,h4{ text-align: center; font-family: Calibri; font-size: 175% ; }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;
		}
		
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
<h2>Animal Condition Types</h2>
<h3>1 = Beginner, 2 = Intermediate, 3 = Advanced</h3>
<div align='center'>
<?php
	$tmpl = array ('table_open' => '<table class="mytable">');
	$this->table->set_template($tmpl); 
	
	$this->db->query('drop table if exists temp');
	$this->db->query('create temporary table temp as (SELECT a.Animal_Name AS "Animal",  
a.condition_id AS "Skill level for Animal",
l.Lesson_Number AS "Lesson Number",
l.lesson_level AS "Lesson Level"
FROM animalsinlesson al
JOIN animal a ON(al.Animal_ID = a.Animal_ID)
JOIN vetlesson l ON(al.Lesson_ID = l.Lesson_Number)
WHERE (a.Condition_ID != l.Lesson_Level))');

	
	$query = $this->db->query('select * from temp;');
	echo $this->table->generate($query);
?>
</div>
<h4>Trainee Lessons</h4>
<div align='center'>
<?php
	$tmpl = array ('table_open' => '<table class="mytable">');
	$this->table->set_template($tmpl); 
	
	$this->db->query('drop table if exists temp');
	$this->db->query('create temporary table temp as (SELECT CONCAT(t.given_name, " ", t.family_name) AS "Full Name",  
t.current_level AS "Skill level for Trainee",
l.Lesson_Number AS "Lesson Number",
l.lesson_level AS "Lesson Level"
FROM traineesinlesson tl
JOIN trainee t ON(tl.trainee_id = t.trainee_id)
JOIN vetlesson l ON(tl.Lesson_no = l.Lesson_Number)
WHERE (t.current_level != l.Lesson_Level))');

	
	$query = $this->db->query('select * from temp;');
	echo $this->table->generate($query);
?>
</div>
</body>
</html>