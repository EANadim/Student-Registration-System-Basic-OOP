<?php

class Course
{
	public $studentList=array();
	public $courseName;

	public function __construct($courseName)
	{
		$this->courseName=$courseName;
	}
	function addStudent($studentName)
	{
		array_push($this->studentList,$studentName);
	}
	function dropStudent($studentName)
	{
		if (($key = array_search($studentName,$this->studentList)) !== false)
		{
    		unset($this->studentList[$key]);
		}
		for($i=0;$i<count($this->studentList);$i++)
		{
			if(!isset($this->studentList[$i]))
			{
				$this->studentList[$i]=null;
			}
		}
	}
	function showStudents()
	{
		echo "<br>"."Student List of the course ".$this->courseName." : ";
		for($i=0;$i<count($this->studentList);$i++)
		{
			echo "<br>".$this->studentList[$i];
		}
	}
}
class Student
{
	public $balance=50000;
	public $courseFee=10000;
	public $courseList=array();
	public $studentName;
	public $transaction;
	
	public function __construct($studentName)
	{
		$this->studentName=$studentName;
	}
	function accountDetails()
	{
		echo "<br>"."Account Information of ".$this->studentName." :";
		echo $this->balance;
	}
	function courseDetails()
	{
		echo "<br>"."Course Information of ".$this->studentName." :";
		for($i=0;$i<count($this->courseList);$i++)
		{
			if(isset($this->courseList[$i]))
			{
				echo "<br>".$this->courseList[$i];
			}
			else
			{
				$this->courseList[$i]=null;
			}
		}
	}
	function addCourse($course)
	{
		if($this->balance<10000)
		{
			echo "Insufficient Balance";
		}
		else
		{
			array_push($this->courseList,$course->courseName);
			$this->balance=$this->balance-$this->courseFee;
			$course->addStudent($this->studentName);
			$this->transaction=$this->transaction.'<br>'.$course->courseName." added with course fee 10000.new balance : ".$this->balance;
		}
	}
	function dropCourse($course)
	{
		if (($key = array_search($course->courseName, $this->courseList)) !== false)
		{
			$this->balance=$this->balance+$this->courseFee;
			$this->transaction=$this->transaction.'<br>'.$course->courseName." dropped with deduction of fee 10000.new balance : ".$this->balance;
    		unset($this->courseList[$key]);
		}
		for($i=0;$i<count($this->courseList);$i++)
		{
			if(!isset($this->courseList[$i]))
			{
				$this->courseList[$i]=null;
			}
		}
		$course->dropStudent($this->studentName);
	}
	function transactionHistory()
	{
		echo "<br>Transaction history of Student ".$this->studentName;
		echo $this->transaction;
	}
}

$php=new Course('PHP'); //Create three objects of the Courseclass.[PHP, JAVA, C]
$java=new Course('JAVA');
$c=new Course('C');

$studentOne=new Student('Nadim');//Create three objects of the Student class. [studentOne, studentTwo, studentThree]
$studentTwo=new Student('Shovon');
$studentThree=new Student('Rashed');

$studentOne->addCourse($php);//Add three courses [PHP, C#, C] to all students]
$studentOne->addCourse($java);
$studentOne->addCourse($c);

$studentTwo->addCourse($php);
$studentTwo->addCourse($java);
$studentTwo->addCourse($c);

$studentThree->addCourse($php);
$studentThree->addCourse($java);
$studentThree->addCourse($c);


$studentOne->dropCourse($c);//Drop onecourse[C]from the studentOne
$studentThree->dropCourse($java);//Drop onecourse [JAVA] from the studentOne

$studentOne->courseDetails();//Show studentOne Account Details and Course Details
$studentOne->accountDetails();

$studentThree->courseDetails();//Show studentThree Account Details and Course Details
$studentThree->accountDetails();

$studentOne->transactionHistory();//Show all the transactions
$studentTwo->transactionHistory();
$studentThree->transactionHistory();

$php->showStudents();//Show all the students from a particular course [PHP]