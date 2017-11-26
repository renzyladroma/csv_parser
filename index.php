<!DOCTYPE html>
<html lang="en">
 
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
 
</head>
 
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
 
                <form class="form-horizontal" action="index.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
 
                        <!-- Form Name -->
                        <legend>CSV Parser</legend>
 
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
 
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
 
                    </fieldset>
                </form>
 
            </div>
            
        </div>
		
		<div class="container">
            <div class="row">
			
				<table class="table table-striped table-hover table-bordered">
				  <thead class="thead">
					<tr>
					  <th>#</th>
					  <th>Item</th>
					  <th>Occurence</th>
					</tr>
				  </thead>
				  <tbody>
					<?php getData(); ?>
				  </tbody>
				</table>
            </div>
        </div>
    </div>
</body>
 
 
<?php
 
	function getData(){
		 $ar1 = array(); 
		 if(isset($_POST["Import"])){
				
				$filename=$_FILES["file"]["tmp_name"];		
				
				 if($_FILES["file"]["size"] > 0){
					$file = fopen($filename, "r");
					while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){ 
						
						$ar1[] = $getData[0];
						
					}
					$ar2 = array_count_values($ar1);
					listData($ar2);
					fclose($file);	
				 }else{
					 echo "<tr><td colspan='5'>No data found.</td></tr>";
				 }
		}else{
			 echo "<tr><td colspan='5'>No data found.</td></tr>";
		 } 
	 
	}
	
	function listData($ar2){
		$i = 1;
		arsort($ar2);
		$result = array_slice($ar2, 0, 10);
		foreach($result as $key => $value){
			echo "<tr>";
				echo "<td>".$i++."</td>";
				echo "<td>".$key."</td>";
				echo "<td>".$value."</td>";
			echo "</tr>";
		}
	}
 
?>
 
</html>