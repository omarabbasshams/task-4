<?php


session_start();

function cleaninput( $inputs){
    
    $inputs['name']=filter_var(trim($inputs['name']),FILTER_SANITIZE_STRING);
    $inputs['email']=filter_var(trim($inputs['email']),FILTER_SANITIZE_EMAIL);
    $inputs['linkedin']=filter_var(trim($inputs['linkedin']),FILTER_SANITIZE_URL);
    return $inputs;
    
    
}
if($_SERVER["REQUEST_METHOD"] == 'POST'){
  $type     = $_FILES['img']['type'];
$allowedExt = ['png','jpg','jpeg'];
$extArray = explode('/',$type);
$clean = cleaninput($_POST);
$errorMessages = [];

    if(empty($clean['name'])){

        $errorMessages['Name'] = "Field Required";
    }


    if(empty($clean['email'])){

        $errorMessages['Email'] = "Field Required";
    }elseif(!filter_var($clean['email'], FILTER_VALIDATE_EMAIL)){
        $errorMessages['Email'] = "Field Not Valid";
    }


    if(strlen($clean['password']) < 6){

        $errorMessages['Password'] = "Length Must be > 5 ch";
    }

    if(strlen($clean['Address']) < 10){

        $errorMessages['Address'] = "Length Must be > 9 ch";
    }
    if(empty($clean['gender'])){

        $errorMessages['gender'] = "Field Required";
    }
    if(empty($clean['linkedin'])){

        $errorMessages['linkedin'] = "Field Required";
    }
    elseif(!filter_var($clean['linkedin'], FILTER_VALIDATE_URL)){
        $errorMessages['linkedin'] = "Field Not Valid";
    }
    if(empty($_FILES)){
      
      $errorMessages['img'] = "img Required";
     }elseif(!in_array($extArray[1],$allowedExt)){
      print_r($_FILES);
      echo $extArray[1];
      $errorMessages['img'] = "img type error";
     }
     if(count($errorMessages) > 0){
     

      foreach($errorMessages as $key => $value){

          echo '* '.$key.' : '.$value.'<br>';
      }


   }else{
      

       $finalName =   rand().time();
       $desPath = './uploads/'.$finalName;
       $tmp_path = $_FILES['img']['tmp_name'];
       if(move_uploaded_file($tmp_path,$desPath)){
        echo '<button><a href="test.php">Show profile</a></button>';
        $_SESSION['profile'] = ['name' => $clean['name'] , 'email' => $clean['email'] , 'img' => $finalName ];
          }
  
   }





  



  
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Register</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="" name="Address" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Address">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">gender</label>
    <input type="" name="gender" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter gender">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">linkedin url</label>
    <input type="text" name="linkedin" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter linkedin url">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Profile Image</label>
    <input type="file" name="img" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter linkedin url">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
