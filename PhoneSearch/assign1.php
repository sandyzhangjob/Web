<?php 
// Shan Zhang, 113004154, INT322-SDD, int322_171d26
// This PHP part contains two functions:
// 		1, loaddata into table
	function loaddata($DBConnect){
		// open 4 files for read
		$itemName = fopen("itemName.txt","r");
		$model	  = fopen("model.txt","r");
		$os 	  = fopen("os.txt","r");
		$price    = fopen("price.txt","r");
		// retrive value from file
		$itemName =  explode(",", fgets($itemName));
		$model	  =  explode(",", fgets($model));
		$os 	  =  explode(",", fgets($os));
		$price    =  explode(",", fgets($price));
		
		// if there is no data in table, then load data into table, otherwise, do nothing
		$QueryResult = mysqli_query($DBConnect, "select * from product;") or die('query failed'. mysqli_error($conn)); 
		
		if (mysqli_num_rows($QueryResult) == 0){
			for($i = 0; $i < 10; $i++){
				$sql = "insert into product values(NULL, '$itemName[$i]', '$model[$i]', '$os[$i]', '$price[$i]');";
				mysqli_query($DBConnect, $sql) or die('query failed'. mysqli_error($conn));
			}
		}
	}
// 		2, display table contents
	function displaydata($DBConnect, $minprice, $maxprice, $product){
		$sql = "select * from product where (price >= $minprice and price <= $maxprice) and model = '$product';" ;
		$QueryResult = mysqli_query($DBConnect, $sql);
		
		if($QueryResult > 0){
			if(mysqli_num_rows($QueryResult) == 0){
				echo '<p> No result found, please search again</p>'. '<br />';
			}
			else{
				echo "	<table width='50%' border='1'>";
				echo "	<tr>
							<th>itemName</th>
							<th>model</th>
							<th>os</th>
							<th>price</th>
						</tr>\n";
				while(($row = mysqli_fetch_row($QueryResult))){
				echo "	<tr>
							<td>{$row[1]}</td>";
				echo "		<td>{$row[2]}</td>";
				echo "		<td>{$row[3]}</td>";
				echo "		<td>{$row[4]}</td>";
				echo "	</tr>				  ";
				}		
				echo "	</table>\n";
				mysqli_free_result($QueryResult);
			}
			echo '<a href="assign1.php"> Back </a>';
		}
		else {
			echo mysqli_connect_error() . mysqli_connect_errno();
		}
	}
?> 

 <?php
	// read database information from topsecret file
	$f    = fopen("/home/int322_171d26/secret/topsecret","r");
	$line = fgets($f);
	$str  = explode(",", $line);
	$dbserver = $str [0];
	$username = $str [1];
	$password = $str [2];
	$dbname   = $str [3];
	
	// connect to the database
	$DBConnect = mysqli_connect("$dbserver", "$username", "$password", "$dbname");
	if (!mysqli_connect_errno($DBConnect)) 
	{ 
		// load data into database, if there is no data in table
		loaddata($DBConnect);
	}
	else {
		echo mysqli_connect_error() . mysqli_connect_errno();
	} // end load data
 
	// if valid is false, it will display the main page.
	$valid = true;
	// error msg
	$errminprice = "";
	$errmaxprice = "";
	$errproduct  = "";
	// variable name
	$product = "";
		
	// validate all the informations
	if($_POST) {
		if(empty($_POST['product'])){
			$errproduct  = "Please choose one model";
			$valid = false;
		}
		else if(empty($_POST['minprice']) || !is_numeric($_POST['minprice'])){
			$errminprice = "Please enter a minimum price, only number accecpted";
			$valid = false;
		}
		else if(empty($_POST['maxprice']) || !is_numeric($_POST['maxprice'])){
			$errmaxprice = "Please enter maximum price, only number accecpted";
			$valid = false;
		}
		else if($_POST['maxprice'] < $_POST['minprice']){
			$errmaxprice = "minimum price is great than maximum price, please enter again";
			$valid = false;
		}
		// if all informations are correct, then display the result
		else {
			// retrive variable from ($_POST[] array)
			$minprice = trim($_POST['minprice']);
			$maxprice = trim($_POST['maxprice']);
			$product  = $_POST['product'];

			// connect to the database
			$DBConnect = mysqli_connect("$dbserver", "$username", "$password", "$dbname");
			// check if there is connect problem
			if (!mysqli_connect_errno($DBConnect)) 
			{ 
				// call function to display searched result
				displaydata($DBConnect, $minprice, $maxprice, $product);	
				mysqli_close($DBConnect);
			}
			else {
				echo mysqli_connect_error() . mysqli_connect_errno();
			}
		}
	}
 ?>
 
 <?php
 // if ther is any error or not submit yet, then redisplay the main page.
 if(!$valid || !$_POST){
 ?>
 
 <html>
 <head><title>Assignment1, Shan Zhang, 113004154</title></head>
 <body>
    <form method="POST" action="assign1.php">
      Choose : 																									
      <select name="product" >
		  <option value="">--Please choose--</option>
		  <option value="apple"   <?php if($_POST) if ($_POST['product'] == 'apple')   echo 'SELECTED'; ?>>Apple</option>		
	      <option value="sumsung" <?php if($_POST) if ($_POST['product'] == 'sumsung') echo 'SELECTED'; ?>>Sumsung</option>
		  <option value="nokia"   <?php if($_POST) if ($_POST['product'] == 'nokia')   echo 'SELECTED'; ?>>Nokia</option>
		  <option value="sony"    <?php if($_POST) if ($_POST['product'] == 'sony')    echo 'SELECTED'; ?>>SONY</option>
      </select> <?php echo $errproduct; ?>  <br><br>
	  
	  Minimum Price: <input type="text" name="minprice" value="<?php if($_POST) if($_POST['minprice']) echo $_POST['minprice']; ?>"> <?php echo $errminprice; ?> <br>
	  Maximum Price: <input type="text" name="maxprice" value="<?php if($_POST) if($_POST['maxprice']) echo $_POST['maxprice']; ?>"> <?php echo $errmaxprice; ?> <br>

	  <input type="submit" value="Submit"> 
    </form>
<?php
}
?>

 </body>
 </html>