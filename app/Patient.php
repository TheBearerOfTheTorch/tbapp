<?php
session_start();
include 'Connection.php';

function testInput($input)
{
    $input = stripslashes($input);
    $input = trim($input);
    $input = htmlspecialchars($input);

    return $input;
}

if(isset($_POST['clinicsname']))
{
    $clinicname = testInput($_POST['nameclinic']);
    $district = testinput($_POST['districtss']);

    //checking if the fields are filled or not
    if(empty($clinicname))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($district)){
        header("Location: /index.php?error=the district field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT clinicname FROM clinics WHERE clinicname=?");
            $stmt->bindValue(1,$clinicname);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the names already exist in our record");
            }
            else
            {
                //submiting the email into the db
                $stmt = $conn->prepare("INSERT INTO clinics (clinicname,district) 
                    VALUES(:clinicname,:district)");
                $stmt->bindParam(":clinicname",$clinicname);
                $stmt->bindParam(":district",$district);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    header("Location: /index.php?success=you have registered successfully");
                }
            }
        }
        catch(PDOException $e)
        {
            // header("Location: /index.php?error=".$e->getMessage());
            echo $e->getMessage();
        }
    }
}
if(isset($_POST['registertoclinic']))
{
    $clinicname = testInput($_POST['clinicname']);

    //checking if the fields are filled or not
    if(empty($clinicname))
    {
        header("Location: ../views/patient.blade.php?error=the name field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT emailS FROM patients WHERE emailS=?");
            $stmt->bindValue(1,$_SESSION['auth']);
            $stmt->execute();

            if($stmt->rowCount())
            {
                //submiting the email into the db
                $stmt = $conn->prepare("UPDATE patients SET clinicname='$clinicname' WHERE emails=?");
                $stmt->bindValue(1,$_SESSION['auth']);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    header("Location: ../views/patient.blade.php?success=you have registered successfully");
                }
            }
            else
            {
                header("Location: ../views/patient.blade.php?error=the names already exist in our record");
            }
        }
        catch(PDOException $e)
        {
            // header("Location: /index.php?error=".$e->getMessage());
            echo $e->getMessage();
        }
    }
}