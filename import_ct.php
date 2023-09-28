<?php
include('db.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) 
    {
        $file = $_FILES["file"]["tmp_name"]; 
        $file_name = $_FILES["file"]["name"]; 

        $upload_directory = "uploads/";

        if (!file_exists($upload_directory)) 
        {
            mkdir($upload_directory, 0777, true);
        }
 
        if (move_uploaded_file($file, $upload_directory . $file_name)) 
        {
            $fileRename = "UpdateFile".trim(date('Y-m-d')).".csv";
            $newname=rename('uploads/'.$file_name,'uploads/'.$fileRename);     
            $csvFile= 'uploads/'.$fileRename; 
            
            if (file_exists($csvFile)) 
            {
                $file = fopen($csvFile, 'r');
                if ($file) 
                {
                    $changesCounter = 1;
                    $xy=0;
                    $newchangesCounter=0;
                    
                    $column = array();

                    while (($data = fgetcsv($file)) !== false) 
                    {
                        echo ltrim($data[0]);
                        if($data[1] == 'FirstName')
                        {
                            for ($i = 1; $i <= 25; $i++) 
                            {
                            $column[] = $data[$i];
                            }
                        }
                        else
                        {
                        $uniqueIdentifier = $data[0];

                        $query = "SELECT * FROM details WHERE StudentID = '$uniqueIdentifier'";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) 
                        {
                            $rowFromDB = $result->fetch_assoc();

                            $y=1;
                            for ($i =0 ; $i <= 23; $i++) 
                            {
                                // echo "<br>";
                                
                                // echo "From C-SHeet ".$data[$y]."   Y value".$y;
                                // echo "<br>";
                                // echo "From DB-Data".$rowFromDB[$column[$i]]."   i value".$i;
                                // echo "<br>";

                                    if (trim($data[$y]) != trim($rowFromDB[$column[$i]])) 
                                    {
                                        $columnName = $column[$i];
                                        $newValue = $data[$y];
                                // echo "<br>";

                                        $u_sql = "UPDATE details SET $columnName = '$newValue' WHERE StudentID = '$uniqueIdentifier'";
                                        $uresult = $conn->query($u_sql);
                                        $xy++;
                                       
                                    }
                                    $y++;
                            }
                           
                        }
                        else
                        {
                            if($data[3] != 'Email')
                            {
                                
                                $columns = implode(', ', array_keys($data));
                                $values = "'" . implode("', '", $data) . "'";
                                // echo "<br>";
                                $sql = "INSERT INTO details (StudentID,FirstName, LastName, Email, Phone, Address, City, State, ZipCode, Country, State2,Street, Company, C_Address, C_Code, Salary, PF, Aadhar_ID, Pan_ID, Vote_ID, Weight,Height, Ration_ID, W_ID, Company_ID) VALUES ($values)";
                                $sql_result = $conn->query($sql);
                            }
                            $newchangesCounter++;
                        }
            $changesCounter++;
                    }
                    // if($data[0]==54)
                    // {
                    // echo "<pre>";
                    // print_r($data);
                    // }
                    // echo "<br>";
                    // print_r($column);
                    // exit;
                    }
                    // echo "Total rows processed: " . $changesCounter . "<br>";
                    // echo "Total rows with changes updated in the database: " . $changesCounter;
                   
                    $_SESSION['changesCounter'] = $changesCounter;
                    $_SESSION['newchangesCounter'] = $newchangesCounter;
                    $_SESSION['xy'] = $xy;
                    fclose($file);
                } else 
                {
                    echo "Error opening the CSV file.";
                }
            } else 
            {
                echo "CSV file not found.";
            }

            echo "File uploaded successfully.";

            header("Location: import.php");
            exit();
        } else 
        {
            echo "Error uploading the file.";
        }
    } else
    {
        echo "Error: " . $_FILES["file"]["error"];
    }
}


?>
