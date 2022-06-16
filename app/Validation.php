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

if(isset($_POST['login']))
{
    $email = testInput($_POST['email']);
    $password = testInput($_POST['password']);

    //checking if the input details are empty
    if(empty($email))
    {
        header("Location: /index.php?error= the email field is empty");
    }
    else if(empty($password))
    {
        header("Location: /index.php?error= the password field is empty");
    }
    else
    {
        //dealing with the database
        try
        {
            $stmt = $conn->prepare("SELECT emails,names,password,types FROM users WHERE emails=?");
            $stmt->bindValue(1,$email);
            $stmt->execute();

            if($stmt->rowCount())
            {
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $passwordDb = $data['password'];
                    $usernameDb = $data['names'];
                    $typeDb = $data['types'];
                    $phoneDb = $data['phone'];

                    //setting up the session
                    $_SESSION['auth'] = $email;
                    $_SESSION['authType'] = $typeDb;
                    $_SESSION['authName'] = $usernameDb;
                    $_SESSION['authPhone'] = $phoneDb;

                    if(md5($password) == $passwordDb)
                    {
                        //directing different users to their respective pages when validation is true
                        if($typeDb == "admin")
                        {
                            header("Location: /views/admin.blade.php");
                        }
                        else if($typeDb == "workers")
                        {
                            header("Location: /views/worker.blade.php");
                        }
                        else if($typeDb == "patient")
                        {
                            header("Location: /views/patient.blade.php");
                        }
                        else if($typeDb == "dispensary")
                        {
                            header("Location: /views/patient.blade.php");
                        }
                        else
                        {
                            header("Location: /index.php?error=the user type is invalid");
                        }
                    }
                    else
                    {
                        header("Location: /index.php?error=the password do not match our records");
                    }
                }
            }
            else
            {
                header("Location: /index.php?error=the email do not exist in our record");
            }
        }
        catch(PDOException $e)
        {
            header("Location: /index.php?error=".$e->getMessage());
        }
    }
}
else if(isset($_POST['register-patients']))
{
    $name = testInput($_POST['name']);
    $email = testinput($_POST['email']);
    $password = testinput($_POST['password']);
    $password1 = testinput($_POST['secondPassword']);
    $phone = testinput($_POST['phone']);
    $location = testinput($_POST['location']);
    $dob = testinput($_POST['dob']);
    $village = testinput($_POST['villages']);
    $nextofkin = testinput($_POST['kin']);
    $status = testinput($_POST['status']);

    //checking if the fields are filled or not
    if(empty($name))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($email))
    {
        header("Location: /index.php?error=the email field is empty");
    }
    else if(empty($password))
    {
        header("Location: /index.php?error=the password field is empty");
    }
    else if(empty($password1))
    {
        header("Location: /index.php?error=the confirmation password is empty");
    }else if(empty($phone))
    {
        header("Location: /index.php?error=the phone field is empty");
    }
    else if(empty($location))
    {
        header("location: /index.php?error=the location field is empty");
    }
    else if(empty($dob)){
        header("Location: /index.php?error=the date of birth is empty");
    }
    else if(empty($village)){
        header("Location: /index.php?error=the village field is empty");
    }
    else if(empty($nextofkin)){
        header("Location: /index.php?error=the next of kin field is empty");
    }
    else if(empty($status)){
        header("Location: /index.php?error=the marital status field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT emails FROM patients WHERE emails=?");
            $stmt->bindValue(1,$email);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the email already exist in our record");
            }
            else
            {
                //checking if the password do match
                if($password == $password1)
                {
                    //encrypting the pass
                    $passwordENC = md5($password);
                    $type = "patient";

                    //submiting the email into the db
                    $stmt = $conn->prepare("INSERT INTO patients (names,emails,phone,location,dob,village,kin,status) 
                        VALUES(:names,:emails,:phone,:location,:dob,:village,:kin,:status)");
                    $stmt->bindParam(":names",$name);
                    $stmt->bindParam(":emails",$email);
                    $stmt->bindParam(":phone",$phone);
                    $stmt->bindParam(":location",$location);
                    $stmt->bindParam(":dob",$dob);
                    $stmt->bindParam(":village",$village);
                    $stmt->bindParam(":kin",$nextofkin);
                    $stmt->bindParam(":status",$status);
                    $rt = $stmt->execute();

                    if($rt > 0)
                    {
                        //emails,names,passwords,types
                        $stmt = $conn->prepare("INSERT INTO users (names,emails,password,types) 
                        VALUES(:names,:emails,:password,:types)");
                         $stmt->bindParam(":names",$name);
                         $stmt->bindParam(":emails",$email);
                         $stmt->bindParam(":password",$passwordENC);
                         $stmt->bindParam(":types",$type);
                         $rt = $stmt->execute();

                         if($rt> 0){
                             //setting up the session
                            $_SESSION['auth'] = $email;
                            $_SESSION['authType'] = "patient";
                            $_SESSION['authName'] = $name;
                            $_SESSION['authPhone'] = $phone;

                            header("Location: /views/patient.blade.php");
                         }

                        
                    }
                }
                else
                {
                    header("Location: /index.php?error=the passwords do not match");
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
else if(isset($_POST['district']))
{
    $name = testInput($_POST['name']);
    $description = testinput($_POST['description']);
    $district = testinput($_POST['district']);
    $address = testinput($_POST['address']);

    //checking if the fields are filled or not
    if(empty($name))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($description)){
        header("Location: /index.php?error=the description field is empty");
    }
    else if(empty($district)){
        header("Location: /index.php?error=the district field is empty");
    }
    else if(empty($address)){
        header("Location: /index.php?error=the addressfield is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT names FROM district WHERE names=?");
            $stmt->bindValue(1,$name);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the names already exist in our record");
            }
            else
            {
                //submiting the email into the db
                $stmt = $conn->prepare("INSERT INTO district (names,description,district, address) 
                    VALUES(:names,:description,:district, :address)");
                $stmt->bindParam(":names",$name);
                $stmt->bindParam(":description",$description);
                $stmt->bindParam(":district",$district);
                $stmt->bindParam(":address",$address);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    header("Location: /indext.php?success=you have registered successfully");
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
else if(isset($_POST['village']))
{
    $clinicname = testInput($_POST['name']);
    $villagename = testinput($_POST['village-name']);
    $district = testinput($_POST['district']);

    //checking if the fields are filled or not
    if(empty($name))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($villagename)){
        header("Location: /index.php?error=the village field is empty");
    }
    else if(empty($district)){
        header("Location: /index.php?error=the district field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT villagename FROM village WHERE villagename=?");
            $stmt->bindValue(1,$villagename);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the names already exist in our record");
            }
            else
            {
                //submiting the email into the db
                $stmt = $conn->prepare("INSERT INTO village (clinicname,villagename,district) 
                    VALUES(:names,:villagename,:district)");
                $stmt->bindParam(":clinicname",$clinicname);
                $stmt->bindParam(":villagename",$villagename);
                $stmt->bindParam(":district",$district);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    header("Location: /indext.php?success=you have registered successfully");
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
else if(isset($_POST['workers']))
{
    $name = testInput($_POST['name']);
    $email = testinput($_POST['email']);
    $password = testinput($_POST['password']);
    $password1 = testinput($_POST['secondPassword']);
    $phone = testinput($_POST['phone']);
    $location = testinput($_POST['location']);

    //checking if the fields are filled or not
    if(empty($name))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($email))
    {
        header("Location: /index.php?error=the email field is empty");
    }
    else if(empty($password))
    {
        header("Location: /index.php?error=the password field is empty");
    }
    else if(empty($password1))
    {
        header("Location: /index.php?error=the confirmation password is empty");
    }else if(empty($phone))
    {
        header("Location: /index.php?error=the phone field is empty");
    }
    else if(empty($location))
    {
        header("location: /index.php?error=the location field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT emails FROM workers WHERE emails=?");
            $stmt->bindValue(1,$email);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the email already exist in our record");
            }
            else
            {
                //checking if the password do match
                if($password == $password1)
                {
                    //encrypting the pass
                    $passwordENC = md5($password);
                    $type = "workers";

                    //submiting the email into the db
                    $stmt = $conn->prepare("INSERT INTO workers (names,emails,passwords,phone,location,types) 
                        VALUES(:names,:emails,:passwords,:phone,:location,:types)");
                    $stmt->bindParam(":names",$name);
                    $stmt->bindParam(":emails",$email);
                    $stmt->bindParam(":passwords",$passwordENC);
                    $stmt->bindParam(":phone",$phone);
                    $stmt->bindParam(":location",$location);
                    $stmt->bindParam(":types",$type);
                    $rt = $stmt->execute();

                    if($rt > 0)
                    {
                         //emails,names,passwords,types
                         $stmt = $conn->prepare("INSERT INTO users (names,emails,passwords,types) 
                         VALUES(:names,:emails,:passwords,:types)");
                          $stmt->bindParam(":names",$name);
                          $stmt->bindParam(":emails",$email);
                          $stmt->bindParam(":passwords",$passwordENC);
                          $stmt->bindParam(":types",$type);
                          $rt = $stmt->execute();
 
                          if($rt> 0){
                            //setting up the session
                            $_SESSION['auth'] = $email;
                            $_SESSION['authType'] = "workers";
                            $_SESSION['authName'] = $name;
                            $_SESSION['authPhone'] = $phone;

                            header("Location: /views/worker.blade.php");
                          }
                        
                    }
                }
                else
                {
                    header("Location: /index.php?error=the passwords do not match");
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
else if(isset($_POST['dispensary']))
{
    $name = testInput($_POST['dname']);
    $clinicname = testinput($_POST['clinic-name']);
    $email = testinput($_POST['email']);
    $password = testinput($_POST['password']);

    //checking if the fields are filled or not
    if(empty($name))
    {
        header("Location: /index.php?error=the name field is empty");
    }
    else if(empty($clinicname)){
        header("Location: /index.php?error=the clinic name field is empty");
    }
    else
    {
        //checking if the email already exist in the database
        try
        {
            $stmt = $conn->prepare("SELECT email FROM dispensary WHERE email=?");
            $stmt->bindValue(1,$email);
            $stmt->execute();

            if($stmt->rowCount())
            {
                header("Location: /index.php?error=the email already exist in our record");
            }
            else
            {
                //submiting the email into the db
                $stmt = $conn->prepare("INSERT INTO dispensary (username,clinicname,email,password) 
                    VALUES(:username,:clinicname,:email,:password)");
                $stmt->bindParam(":username",$name);
                $stmt->bindParam(":clinicname",$clinicname);
                $stmt->bindParam(":email",$email);
                $stmt->bindParam(":password",$password);
                $rt = $stmt->execute();

                if($rt > 0)
                {
                    $type = "dispensary";
                    //emails,names,passwords,types
                    $stmt = $conn->prepare("INSERT INTO users (names,emails,password,types) 
                    VALUES(:names,:emails,:password,:types)");
                     $stmt->bindParam(":names",$name);
                     $stmt->bindParam(":emails",$email);
                     $stmt->bindParam(":password",$passwordENC);
                     $stmt->bindParam(":types",$type);
                     $rt = $stmt->execute();

                     if($rt> 0){
                        //setting up the session
                        $_SESSION['auth'] = $email;
                        $_SESSION['authType'] = "dispensary";
                        $_SESSION['authName'] = $name;

                        header("Location: /views/dispensary.blade.php");
                     }
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
else
{
    if(!isset($_SESSION['auth']))
    {
        header("Location: /index.php?error=unauthorised page request");
    }
}