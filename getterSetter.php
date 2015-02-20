<?php
/*=================================================
=            Simpe PHP Getter & Setter            =
=================================================*/

/* 
* Author:- Rob Cullen 
*
* A simple and effective way to manage your functions and database querying
* this code is example work only and has no injection checking
*
* Include your database connection
*
* @param require_once('dbc.php');
*
*/

class className{

	function __construct()
	{
		$sql = new DB_class();
	}
	// Assign the database connection to our class



	private function queryDB($query)
	{
		$mysql = mysqli_query($query) or die(mysql_error());
			if(mysqli_num_rows($mysql) > 0)
			{
				$array = array();
				while($row = mysqli_fetch_array($mysql))
				{
					$array[] = $row;
				}
			return $array;
			}
	}
	// Creating the db query as a function removes duplication of code, private means only the class can call it



		private function insertDB($query)
		{
			$mysql = mysqli_query($query) or die(mysql_error());
				if($mysql)
				{
					return true;
					// header('location: page-to-redirect.php');
				}
		}


		/**
		*
		* We could insert the $string directly in to our queryDB but we might need to do something 
		* different for each function as exampled below
		*
		**/



		public function getter($string)
		{
		// add some clean up of string mysql_real_escape_string($string);
			$query = "SELECT id,name FROM table WHERE name = '$string'";
			return $this->queryDB($query);
			//returns an array from the db if anything matched our query
		}


			public function getter1($string1)
			{
			// add some clean up of string mysql_real_escape_string($string1);
				$query = "SELECT id,country FROM table1 WHERE name = '$string1'";
				return $this->queryDB($query);
				//returns an array from the db if anything matched our query
			}
			// Example of querying a different table or values with no need to duplicate the db fetch code



		public function setter($string)
		{
			$query = "INSERT INTO table (id,name,date) VALUES(1,'$string',NOW())";
				return $this->insertDB($query);
		}
		// Example of adding data to the db


} 
// close class

/**
*
* How to access our class and functions
*
**/

	$className = new className();
	// Create a new instance of the class
	// variations $className = new className; or $className = new className('getter');
	// Ideally you would call this on a page such as members.php / home.php and include the class: require_once('class.php');


		$string = "Rob Cullen"; 
			$array = $className->getter($string); 
			// variation $array = $className->getter("Rob Cullen"); or $array = $className->getter(mysql_real_escape_string($string));

				if(!empty($array))
				{
					foreach($array as $arr)
					{
						echo 'My name is '.$arr['name'];
					}
					//loop through all our array results
				}
				//if our array is not empty loop through the results


		$string1="United Kingdom";
			$array = $className->getter1($string1);
			// example of querying a new table, you can use the same looping foreach as above



	//adding value to db

	if(isset($_POST['string']))
	{
		if($className->setter(mysqli_real_escape_string($_POST['string'])))
		{
			echo "Successfully inserted result";
		}
		//We can short code the instance in to a IF statement to say if the return is true echo Successfully inserted result, we can also escape the string for potienial injection
		// this method only works if you set the response to TRUE OR FALSE


		/*
		*
		*	else {echo "The result did not insert";}
		*
		*/
	}
	// Check if the post name was sent in a form


/*-----  End of Simpe PHP Getter & Setter  ------*/





