<?php

include_once("./dbconnection.php");

if(isset($_POST["upload"])){

    $csv_file = $_FILES["csv_file"]["name"];
    $directory = "./csvfiles/".$csv_file;
    $file_open = fopen($directory, "r"); 
            
    while(!feof($file_open)){
        $Arr = fgetcsv($file_open);
        if(is_array($Arr)){

            $name = $Arr[0];
            $age = $Arr[1];
            $dist = $Arr[2];
            $course = $Arr[3];
            $email = $Arr[4];

        if($Arr[0] != "Name"){
        
        $select_query = "SELECT * FROM myclassdata where email='$email' ";
        $selectQueryRun = mysqli_query($conn, $select_query);
                       
            if(mysqli_num_rows($selectQueryRun) > 0){

                $fetch_db_data = mysqli_fetch_assoc($selectQueryRun);
                $fetch_name = $fetch_db_data["name"];
                $fetch_age = $fetch_db_data["age"];
                $fetch_dist = $fetch_db_data["dist"];
                $fetch_course = $fetch_db_data["course"]; 


                if($fetch_name == $name && $fetch_age == $age && $fetch_dist == $dist && $fetch_course == $course){
                
                        echo $fetch_db_data["email"]."<br>"; 
                }else{

                        if(($fetch_name != $name) && ($name != "")){
                             mysqli_query($conn, "UPDATE `myclassdata` SET `name`='$name' where email='$email' ");
                            
                        }  
                        if(($fetch_age != $age) && ($age != "")){
                             mysqli_query($conn, "UPDATE `myclassdata` SET `age`='$age' where email='$email' ");
                            
                        }   
                        if(($fetch_dist != $dist) && ($dist != "")){
                             mysqli_query($conn, "UPDATE `myclassdata` SET `dist`='$dist' where email='$email' ");
                            
                        }  
                        if(($fetch_course != $course) && ($course != "")){
                             mysqli_query($conn, "UPDATE `myclassdata` SET `course`='$course' where email='$email' ");
                        
                        }      
                        
                        echo "<br>";
                }
                    
            }else{
                $insert = "INSERT INTO `myclassdata`(`name`, `age`, `dist`, `course`, `email`) VALUES ('$name','$age','$dist','$course','$email')";
            
                $importquery = mysqli_query($conn,$insert);
                if($importquery){
                    echo "<h2>inserted</h2>";
                }else{
                    echo "<h2>not inserted</h2>";
                }

                
        }
    }
}

}     
        
        fclose($file_open);
}


?>
</table>


<form method="post" enctype="multipart/form-data">
    <input type="file" name="csv_file"><br><br>
    <input type="submit" name="upload">
</form>