<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	 
	 function __construct()
	{
		parent::__construct();	 
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('table');
	}
	
	public function index()
	{	
		$this->load->view('header');
		$this->load->view('home');
	}
	
	public function animal()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		//table name exact from database
		$crud->set_table('animal');
		
		//give focus on name used for operations e.g. Add animal, Delete animal
		$crud->set_subject('animal');
		
		//the columns function lists attributes you see on frontend view of the table
		$crud->columns('Animal_ID', 'Animal_Name', 'Owner_ID', 'Height', 'Weight', 'Condition_Name', 'Condition_Level', 'Availability');
	
		//the fields function lists attributes to see on add/edit forms.
		//Note no inclusion of invoiceNo as this is auto-incrementing
		$crud->fields ('Animal_Name', 'Owner_ID', 'Height', 'Weight', 'Condition_Name','Availability');
		
		//set the foreign keys to appear as drop-down menus
		// ('this fk column','referencing table', 'column in referencing table')
		//$crud->set_relation('owner','Owner_ID','condition_Name');
		
		//many-to-many relationship with link table see grocery crud website: www.grocerycrud.com/examples/set_a_relation_n_n
		//('give a new name to related column for list in fields here', 'join table', 'other parent table', 'this fk in join table', 'other fk in join table', 'other parent table's viewable column to see in field')
		$crud->set_relation('Owner_ID','owner', 'Owner_ID');
		//$crud->set_relation_n_n('Animal_ID','animal', 'Animal_ID');
		//$crud->set_relation_n_n('Lesson_ID','vetlesson', 'Lesson_ID);
		$crud->set_relation('Condition_Name','diagnosis', 'Condition_Name');
		$crud->set_relation('Condition_Level','diagnosis', 'Condition_Level');
		$crud->set_relation('Condition_Level','diagnosis', 'Condition_Level');
		
		//form validation (could match database columns set to "not null")
		$crud->required_fields('Animal_ID', 'Animal_Name', 'Owner_ID', 'Height', 'Weight', 'Condition_Name', 'Condition_Level');
		
		//change column heading name for readability ('columm name', 'name to display in frontend column header')
		$crud->display_as('Animal_ID', 'Animal ID');
		$crud->display_as('Condition_Name', 'Condition Name');
		$crud->display_as('Condition_Level', 'Condition Level');
		
		$output = $crud->render();
		$this->animal_output($output);
	}
	
	function animal_output($output = null)
	{
		//this function links up to corresponding page in the views folder to display content for this table
		$this->load->view('animal_view.php', $output);
	}

	public function animalsinlesson()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('animalsinlesson');
		$crud->set_subject('animalsinlesson');
		$crud->columns('Animal_ID', 'Lesson_ID');
		$crud->fields('Animal_ID', 'Lesson_ID');
		$crud->required_fields('Animal_ID', 'Lesson_Id');
		$crud->set_relation('Animal_ID', 'Animal', 'Animal_ID');
		$crud->set_relation('Lesson_ID', 'vetlesson', 'Lesson_Number');
		$crud->display_as('Vetlesson', 'Lesson');
		$crud->display_as('animalsinlesson', 'Animals in lesson');
		
		$output = $crud->render();
		$this->animalsinlesson_output($output);
	}
	
	function animalsinlesson_output($output = null)
	{
		$this->load->view('animalsinlesson_view.php', $output);
	}
	public function owner()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('owner');
		$crud->set_subject('owner');
		$crud->fields('Given_Name', 'Family_Name', 'Mobile_Number');
		$crud->columns('Owner_Id','Given_Name', 'Family_Name', 'Mobile_Number');
		$crud->required_fields('Owner_Id','Given_Name', 'Family_Name', 'Mobile_Number');
		$crud->display_as('Owner_Id', 'Owner ID');
		$crud->display_as('Given_Name', 'First Name');
		$crud->display_as('Family_Name', 'Last Name');
		$crud->display_as('Mobile_Number', 'Number');
		
		$output = $crud->render();
		$this->owner_output($output);
	}
	
	function owner_output($output = null)
	{
		$this->load->view('Owner_view.php', $output);
	}
	
		public function diagnosis()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('diagnosis');
		$crud->set_subject('diagnosis');
		$crud->fields('Condition_Name', 'Condition_Level');
		$crud->required_fields('Condition_Name', 'Condition_Level');
		$crud->display_as('Condition_Name', 'Condition');
		$crud->display_as('Condition_Level', 'Condition Level');
		
		$output = $crud->render();
		$this->diagnosis_output($output);
	}
	
	function diagnosis_output($output = null)
	{
		$this->load->view('diagnosis_view.php', $output);
	}
	
		
		public function trainee()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('trainee');
		$crud->set_subject('trainee');
		$crud->fields('Given_Name', 'Family_Name', 'Current_level');
		$crud->required_fields('Trainee_ID', 'Given_Name', 'Family_Name', 'Current_level');
		$crud->display_as('Trainee_ID', 'Trainee ID');
		$crud->display_as('Given_Name', 'First Name');
		$crud->display_as('Family_Name', 'Last Name');
		$crud->display_as('Current_level', 'Current Level');
		
		$output = $crud->render();
		$this->trainee_output($output);
	}
	
	function trainee_output($output = null)
	{
		$this->load->view('trainee_view.php', $output);
	}
	
		public function traineesinlesson()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('traineesinlesson');
		$crud->set_subject('traineesinlesson');
		$crud->fields('Trainee_ID', 'Lesson_No');
		$crud->required_fields('Trainee_ID', 'Lesson_No');
		$crud->display_as('Trainee_ID', 'Trainee ID');
		$crud->display_as('Lesson_No', 'Lesson Number');
		$crud->set_relation('Trainee_ID','trainee', 'Trainee_ID');
		$crud->set_relation('Lesson_No','vetlesson', 'Lesson_Number');
		
		$output = $crud->render();
		$this->traineesinlesson_output($output);
	}
	
	function traineesinlesson_output($output = null)
	{
		$this->load->view('traineesinlesson_view.php', $output);
	}
	
		public function vetlesson()
	{	
		$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('vetlesson');
		$crud->set_subject('vetlesson');
		$crud->fields('Lesson_Level', 'Lesson_Date', 'Lesson_Time', 'Offest_Cost');
		$crud->columns('Lesson_Number','Lesson_Level', 'Lesson_Date', 'Lesson_Time', 'Offest_Cost');
		$crud->required_fields('Lesson_Number', 'Lesson_Level', 'Lesson_Date', 'Lesson_Time', 'Offest_Cost');
		$crud->display_as('Lesson_Number', 'Lesson Number');
		$crud->display_as('Lesson_Level', 'Lesson Level');
		$crud->display_as('Lesson_Date', 'Lesson Date');
		$crud->display_as('Lesson_Time', 'Time');
		$crud->display_as('Offest_Cost', 'Discount');
		
		$output = $crud->render();
		$this->vetlesson_output($output);
	}
	
	function vetlesson_output($output = null)
	{
		$this->load->view('vetlesson_view.php', $output);
	}
	
	
	
	public function querynav()
	{	
		$this->load->view('header');
		$this->load->view('querynav_view');
	}
		
	public function query1()
	{	
		$this->load->view('header');
		$this->load->view('query1_view');
	}
	
	public function query2()
	{	
		$this->load->view('header');
		$this->load->view('query2_view');
	}
	
	public function blank()
	{	
		$this->load->view('header');
		$this->load->view('blank_view');
	}
}
