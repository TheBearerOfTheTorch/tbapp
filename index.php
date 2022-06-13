<!DOCTYPE html>
<html lang="en" >
<html>
    <head>
    <meta charset="UTF-8">
        <title>tb app</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
            
            <style>
            ul li{list-style:none;}
            ul li a {color:black;font-weight:bold;text-decoration:none; }
            ul li a:hover {color:black;text-decoration:none;}
            </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top ">
            <a class="navbar-brand" href="../index.php"><span style="color:#ED2553;font-family: 'Permanent Marker', cursive;">TB Drug Distribution App</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="../index.php" style="color:#BDDEFD">Home
                        
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../aboutus.php" style="color:#BDDEFD">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../services.php" style="color:#BDDEFD">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../contact.php" style="color:#BDDEFD">Contact</a>
                </li>
            </ul>
            </div>
        </nav>
        <br><br><br>
        <div class="middle" style="padding:20px;margin-bottom:20px; border:1px solid #ED2553; margin:0px auto;width:400px;">
            <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" style="color:#BDDEFD;" id="login-tab" data-toggle="tab" href="#login" 
                    role="tab" aria-controls="login" aria-selected="true">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="color:#BDDEFD;" id="login-tab" data-toggle="tab" href="#register-patient" 
                    role="tab" aria-controls="login" aria-selected="true">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="color:#BDDEFD;" id="login-tab" data-toggle="tab" href="#district" 
                    role="tab" aria-controls="login" aria-selected="true">District</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="color:#BDDEFD;" id="login-tab" data-toggle="tab" href="#village" 
                    role="tab" aria-controls="login" aria-selected="false">Village</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " style="color:#BDDEFD;" id="login-tab" data-toggle="tab" href="#clinics" 
                    role="tab" aria-controls="login" aria-selected="false">Clinics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="signup-tab" style="color:#BDDEFD;" data-toggle="tab" href="#signup"
                     role="tab" aria-controls="signup" aria-selected="false">Healthy worker</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="signup-tab" style="color:#BDDEFD;" data-toggle="tab" href="#dispensary"
                     role="tab" aria-controls="signup" aria-selected="false">Dispensary</a>
                </li>
            </ul>
            <br>
            <div class="tab-content" id="myTabContent">
                <!--login Section-- starts-->
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                    <div class="footer" style="color:red;"></div>
                    <form method="POST" action="app/Validation.php">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" required/>
                        </div>
        
                        <button type="submit" name="login" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Login</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>

                <!--registering patients -->
                <div class="tab-pane fade show " id="register-patient" role="tabpanel" aria-labelledby="home-tab">
                    <div class="footer" style="color:red;"></div>
                    <form method="POST" action="app/Validation.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name"  class="form-control" name="name" required="required"/>
                        </div>
                        
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="mobile">DOB</label>
                            <input type="date" id="dob" class="form-control" name="dob"  placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Next of kin</label>
                            <input type="text" id="kin" class="form-control" name="kin"  placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="mobile">Village</label>
                            <input type="text" id="villages" class="form-control" name="villages"  placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" required/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirm Password:</label>
                            <input type="password" name="secondPassword" class="form-control" id="pwd" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" id="phone" class="form-control" name="phone" placeholder="" required>
                        </div>
                            
                        <div class="form-group">
                            <label for="mobile">Location</label>
                            <input type="text" id="location" class="form-control" name="location"  placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Marital status</label>
                            <input type="text" id="status" class="form-control" name="status"  placeholder="" required>
                        </div>
                        <button type="submit" name="register-patients" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Patients</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>

                <!-- register district -->
                <!-- Name, Description, District Head and Office Address -->
                <div class="tab-pane fade show " id="district" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" action="app/Validation.php">
                        <div class="form-group">
                            <label for="mobile">Name</label>
                            <input type="text" id="name" class="form-control" name="name"  placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="mobile">District</label>
                            <input type="text" id="district" class="form-control" name="district"  placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Description</label>
                            <input type="text" name="description" class="form-control" id="description" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="text">Office Address</label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="" required>
                        </div>
                        <button type="submit" name="district" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Districts</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>
                
                <!-- register village here -->
                <div class="tab-pane fade show " id="village" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" action="app/Validation.php">
                        <div class="form-group">
                            <label for="mobile">Clinic name</label>
                            <input type="text" id="name" class="form-control" name="name"  placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="mobile">District</label>
                            <input type="text" id="district" class="form-control" name="district"  placeholder="" required>
                        </div> 
                        <div class="form-group">
                            <label for="mobile">Village name</label>
                            <input type="text" id="village-name" class="form-control" name="village-name"  placeholder="" required>
                        </div>  

                        <button type="submit" name="village" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Village</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>

                <!-- registering clinics -->
                <div class="tab-pane fade show" id="clinics" role="tabpanel" aria-labelledby="home-tab">
                    <div class="footer" style="color:red;"></div>
                    <form method="POST" action="app/Patient.php">
                        <div class="form-group">
                            <label for="mobile">Clinic name</label>
                            <input type="text" id="nameclinic" class="form-control" name="nameclinic"  placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="mobile">District</label>
                            <input type="text" id="districtss" class="form-control" name="districtss" placeholder="" required>
                        </div> 
                        <button type="submit" name="clinicsname" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Clinics</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>

                <!-- Registering dispensary -->
                <div class="tab-pane fade show" id="dispensary" role="tabpanel" aria-labelledby="home-tab">
                    <div class="footer" style="color:red;"></div>
                    <form method="POST" action="app/Validation.php">
                    <div class="form-group">
                            <label for="mobile">User name</label>
                            <input type="text" id="dname" class="form-control" name="dname"  placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Clinic name</label>
                            <input type="text" class="form-control" name="clinic-name"  placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" required/>
                        </div> 
                        <button type="submit" name="dispensary" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Register</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>
                <!--login Section-- ends-->
                    
                <!--new account Section-- starts-->
                <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="profile-tab" >
                    <label>Village Health Workers</label>
                    <form method="POST" action="app/Validation.php">
                        <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name"  class="form-control" name="name" required="required"/>
                        </div>
                        
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="" required="required"/>
                        </div>
                            
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" required/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirm Password:</label>
                            <input type="password" name="secondPassword" class="form-control" id="pwd" required/>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" id="phone" class="form-control" name="phone" placeholder="" required>
                        </div>
                            
                        <div class="form-group">
                            <label for="mobile">Location</label>
                            <input type="text" id="location" class="form-control" name="location"  placeholder="" required>
                        </div>
                        <button type="submit" name="workers" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Create New Account</button>
                        <div class="footer" style="color:red;"></div>
                    </form>
                </div>
            </div>
        </div>
        <br>
                <br>
    </body>
</html>
