<?php
    session_start();
    //checking if the session is set
    if(isset($_SESSION['auth']))
    {
        if($_SESSION['authType'] != "patient")
        {
            header("Location: /index.php?error=unauthorised page request");
        }
        else
        {
            //end of the first cut
        ?>
        <!DOCTYPE html>
        <html lang="en" >
        <html>
            <head>
                <title>TB Dreg delivery app</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
                <style>
                    ul li{}
                    ul li a {color:black;}
                    ul li a:hover {color:black; font-weight:bold;}
                    ul li {list-style:none;}

                    ul li a:hover{text-decoration:none;}
                    #social-fb,#social-tw,#social-gp,#social-em{color:blue;}
                    #social-fb:hover{color:#4267B2;}
                    #social-tw:hover{color:#1DA1F2;}
                    #social-gp:hover{color:#D0463B;}
                    #social-em:hover{color:#D0463B;}
                </style>
            </head>
            <body>
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                    <div class="container">
                        <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">TB drug delivery system </span></a>
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- this for the drop down -->
                            <button
                                data-toggle="collapse" class="navbar-toggler collapsed" data-target="#navcol-1">
                                <span>MENU</span>
                            </button>
                            <div class="collapse navbar-collapse text-center" id="navcol-1">
                                <ul class="nav navbar-nav ml-auto">
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"><i class="far fa-bell" style="font-size: 23px;"></i></a></li>
                                    <li class="dropdown nav-item">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Profile</a>
                                        <div class="dropdown-menu text-center" style="color:white" role="menu">
                                            <a class="dropdown-item" role="presentation" href="../app/Logout.php">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--navbar ends-->

                <!--details section-->
                <div class="container" style="margin-top:20px;">
                    <!--tab 1 starts checking for the status of the case-->
                    <a id="director_rejobs_link" href="#" data-target="#manageaccount" data-toggle="modal" style="margin-left:50px;">
                        <button type="button" class="btn btn-danger"><h4>Register to a clinic</h4> </button>
                    </a>
                    <a id="director_rejobs_link" href="#" data-target="#order_list" data-toggle="modal" style="margin-left:450px;">
                        <button type="button" class="btn btn-danger"><h4>Requests</h4> </button>
                    </a>
                    <div class="tab-content" id="myTabContent">
                        <?php
                            //database connection
                            $servername = '127.0.0.1';
                            $dbname = 'tbapp';
                            $username = 'root';
                            $pass = "";
                            try
                            {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pass);
                                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                                $stmt = $conn->prepare("SELECT * FROM patients");
                                $stmt->execute();

                                if($stmt->rowCount())
                                {
                                    while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $name = $data['names'];
                                        $emails = $data['emails'];
                                        $location = $data['location'];
                                        $village = $data['village'];
                                        $clinicname = $data['clinicname'];
                                        $approval = $data['approval'];
                        ?>
                    
                        <div class="tab-pane fade show active" style="margin-top:30px;" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                            <div class="container">
                                <div class="card" style="margin-left:140px;margin-right:140px;">
                                    <div class="card-header" style="margin-left:240px;margin-right:230px;">
                                        <h3>Patient Data Profile </h3>
                                    </div>
                                    <div class="card-body" style="margin-left:270px;hight:100px;">
                                        <b>Name:</b> <?php echo $name;?><br>
                                        <b>Emails:</b> <?php echo $emails;?><br>
                                        <b>Location:</b> <?php echo $location?><br>
                                        <b>Village:</b> <?php echo $village?><br>
                                        <b>Clinic name:</b> <?php 
                                        if(empty($clinicname)){
                                            echo "Clinic Registration Pending";
                                        }
                                        else{
                                            echo $clinicname;
                                        }
                                        ?><br>
                                        <b>Approved by clinic:</b> <?php 
                                        if(!empty($approval)){
                                            ?>
                                            <H2 style="color: red" >
                                                <?php
                                                echo "Not Registered";
                                                ?>
                                            </H2>
                                            <?php
                                        }
                                        else{
                                            echo $approval;
                                        }
                                        ?><br>
                                    </div>
                                </div>
                            </div> 
                            
                            <span style="color:green; text-align:centre;"></span>
                        </div>
                        <?php
                                    }
                                }
                            }
                            catch(PDOException $e)
                            {
                                echo "failed to establish a connection with the database. server might be off";
                                echo $e->getMessage();
                            }

                        ?>
                        <!--tab 1 ends-->
                            
                        <!--tab 2 starts-->
                        <div class="modal fade" role="dialog" tabindex="-1" id="manageaccount" style="margin-top:50px;" role="tabpanel" aria-labelledby="manageaccount-tab">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-center" style="width: 100%;">Register Under a clinic for meds</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                        <div class="modal-body">
                                            <label ></label>
                                                <?php
                                                    //database connection
                                                    $servername = '127.0.0.1';
                                                    $dbname = 'tbapp';
                                                    $username = 'root';
                                                    $pass = "";
                                                    try
                                                    {
                                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pass);
                                                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                                        
                                                        //
                                                        $stmt = $conn->prepare("SELECT * FROM clinics ");
                                                        $stmt->execute();

                                                        if($stmt->rowCount())
                                                        { 
                                                            $clinics = array();

                                                            while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                                                            { 
                                                                $name = $data['clinicname'];
                                                                $caseid = $data['district'];

                                                                $arrLength = count($clinics);

                                                                for($i = 0; $i <1; $i++){
                                                                    $clinics[] = $name;
                                                                }
                                                            }
                                                            ?>
                                                                <Form action="../app/Patient.php" method="post">
                                                                    <label for="clinics"><h5>Registered clinics</h5></label>
                                                                    <br>
                                                                    <?php
                                                                        foreach ($clinics as $key => $value) {
                                                                            echo '* '.$value . '<br>';

                                                                        }
                                                                    ?>
                                                                    <br>
                                                                    <input type="text" class="form-control" value="" placeholder="Clinic name" name="clinicname" required><br>
                                                                    <button type="submit" name="registertoclinic" class="btn btn-warning">Register to the clinic</button>
                                                                </Form>
                                                            <?php
                                                        }
                                                    }
                                                    catch(PDOException $e)
                                                    {
                                                        echo "failed to establish a connection with the database. server might be off";
                                                        echo $e->getMessage();
                                                    }

                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- writing the report -->
                <div class="modal fade" role="dialog" tabindex="-1" id="order_list" style="margin-top: 70px;font-style:normal;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title text-center" style="width: 100%;">Requests</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <form action="../app/Patient.php" method="post">
                                        <button type="submit" name="med" class="btn btn-primary">Requests medication</button>
                                        <button type="submit" name="visit" class="btn btn-warning">Requests home visit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-basic" style="margin-left:500px;">
                    <footer>
                        <p class="copyright">TB DRUG DELIVERY SYSTEM ONLINE--- The Bearer © 2022</p>
                    </footer>
                </div>
            <?php
            //beggining
        }
    }
    else
    {
        header("Location: /index.php?error=unauthorised page request");
    }
?>