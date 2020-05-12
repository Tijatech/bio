<?php



if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['bdate'];
    $url = $_POST['url'];
    $state = $_POST['state'] ;
    $country = $_POST['country'];
    $city = $_POST['city'];

    $company_name = $_POST['company_name'];
    $company_loc = $_POST['company_loc'];
    $job = $_POST['job_title'];
     $duties = $_POST['duties'];
    $sdate = $_POST['start_date'];
    $edate = $_POST['end_date'];
    

    // errors check
    $errors = [];
    //Error check for Firstname
    if (strlen($fname) == 0 || $fname == ' ') {
        $errors['fname'] =  'First Name is required';
    }else {
        if (intval($fname) == true) {
            $errors['fname'] =  'First Name is cant be numbers only';
        }
        if (strlen($fname) < 3 && intval($fname) == false) {
            $errors['fname'] =  'First Name is cant be less than 3 characters';
        }
    }

    //Error check for LastName
    if (strlen($lname) == 0 || $lname == ' ') {
        $errors['lname'] =  'Last Name is required';
    }else {
        if (intval($lname) == true) {
            $errors['lname'] = 'Last Name is cant be numbers only';
        }
        if (strlen($lname) < 3 && intval($lname) == false) {
            $errors['lname'] =  'Last Name is cant be less than 3 characters';
        }
    }

    //Error check for Email
    if (strlen($email) == 0 || $email == ' ') {
        $errors['email'] =  'Email is required';
    }else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['fname'] =  'Enter a valid email';
        }
    }

    //Error check for phone
    if (strlen($phone) == 0 || $phone == ' ') {
        $errors['phone'] =  'Phone is required';
    }else {
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        echo $phone;
        if (!$phone) {
            $errors['phone'] =  'Phone is not valid';
        }
        if(strlen(str_replace('-', '',$phone)) < 10 || strlen(str_replace('-', '',$phone)) > 14){
            $errors['phone'] =  'Phone is not valid';
        }

    }


    if (strlen($dob) == 0 || $dob == ' ') {
        $errors['dob'] =  'Date of Birth is required';
    }else {
        $dbirth = strtotime($dob);
        $dat = strtotime('-18 years');
        if ($dbirth > $dat) {
            $errors['dob'] =  'Youre younger than 18';
        }
       
    }

    //Twiter url error check
    if (strlen($url) == 0 || $url == ' ') {
        $errors['url'] =  'Twitter Url is required';
    }else {
        if (!preg_match("/http(?:s)?:\/\/(?:www\.)?twitter\.com*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            $errors['url'] =  'Twitter Url is not valid';
        }
    }


    //Location validation
    if (strlen($country) == 0 || $country == ' ') {
        $errors['country'] = 'Country is required';
    }else {
        if (intval($country) == true) {
            $errors['country'] = 'Country cant be numbers';
        }
        if (strlen($country) < 5 && intval($country) == false) {
            $errors['country'] = 'Country cant be less than 3 characters';
        }
    }
    if (strlen($state) == 0 || $state == ' ') {
        $errors['state'] =  'State is required';
    }else {
        if (intval($state) == true) {
            $errors['state'] =  'State cant be numbers';
        }
        if (strlen($state) < 4 && intval($state) == false) {
            $errors['state'] =  'State cant be less than 3 characters';
        }
    }
  
    if (strlen($city) == 0 || $city == ' ') {
        $errors['city'] =  'City is required';
    }else {
        if (intval($city) == true) {
            $errors['city'] =  'City cant be numbers';
        }
        if (strlen($city) < 4  && intval($city) == false) {
            $errors['city'] =  'City cant be less than 3 characters';
        }
    }




    //Work Experience validation
    if (strlen($company_name) == 0 || $company_name == ' ') {
        $errors['company_name'] =  'Company Name is required';
    }
    if (strlen($company_loc) == 0 || $company_loc == ' ') {
        $errors['company_loc'] =  'Company Location is required';
    }
    if (strlen($job) == 0 || $job == ' ') {
        $errors['job'] =  'Job Title is required';
    }
    if (strlen($duties) == 0 || $duties == ' ') {
        $errors['duties'] =  'Duties is required';
    }
    if (strlen($sdate) == 0 || $sdate == ' ') {
        $errors['sdate'] =  'Start Date is required';
    }
    if (strlen($edate) == 0 || $edate == ' ') {
        $errors['edate'] =  'End Date is required';
    }
if (empty($errors)) {
    $data = [
        'First Name' => $fname,
        'Last Name' => $lname,
        'Date of Birth' => $dob,
        'Country' => $country,
        'State' => $state,
        'City' => $city,
        'Email' => $email,
        'Phone' => $phone,
        'Twitter Url' => $url,
        'Company Name'=>$company_name,
        'Company Location'=>$company_loc,
        'Job Title'=>$job,
        'Duties' => $duties,
        'Start Date' => $sdate,
        'End Date' => $edate
    ];
}
    
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Bio Data</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="POST">
            <input type="text" name="fname" placeholder="First Name *">
            <span class="error"><?php echo $error = (isset($errors['fname'])) ? $errors['fname'] : '' ; ?></span> 
            <input type="text" name="lname" placeholder="Last Name *">
            <span class="error"><?php echo $error = (isset($errors['lname'])) ? $errors['lname'] : '' ; ?></span> 
            <input type="text" name="bdate" id="" placeholder="Date of birth *" onfocus="(this.type = 'date')">
            <span class="error"><?php echo $error = (isset($errors['dob'])) ? $errors['dob'] : '' ; ?></span> 
            <input type="text" name="country" id="" placeholder="Country *"> 
            <span class="error"><?php echo $error = (isset($errors['country'])) ? $errors['country'] : '' ; ?></span> 
            <input type="text" name="state" id="" placeholder="State *">
           <span class="error"><?php echo $error = (isset($errors['state'])) ? $errors['state'] : '' ; ?></span> 
            <input type="text" name="city" id="" placeholder="City *">
           <span class="error"><?php echo $error = (isset($errors['city'])) ? $errors['city'] : '' ; ?></span> 
            <input type="text" name="email" id="" placeholder="Email *">
           <span class="error"><?php echo $error = (isset($errors['email'])) ? $errors['email'] : '' ; ?></span> 
            <input type="text" name="phone" id="" placeholder="Phone *">
           <span class="error"><?php echo $error = (isset($errors['phone'])) ? $errors['phone'] : '' ; ?></span> 
            <input type="text" name="url" id="" placeholder="Twitter Url *">
            <span class="error"><?php echo $error = (isset($errors['url'])) ? $errors['url'] : '' ; ?></span> 


            <div class="work-exp">
                <input type="text" name="company_name" id="" placeholder="Company Name">
           <span class="error"><?php echo $error = (isset($errors['company_name'])) ? $errors['company_name'] : '' ; ?></span> 
                <input type="text" name="company_loc" id="" placeholder="Company Location">
                <span class="error"><?php echo $error = (isset($errors['company_loc'])) ? $errors['company_loc'] : '' ; ?></span> 
                <input type="text" name="job_title" id="" placeholder="Job Title">
                <span class="error"><?php echo $error = (isset($errors['job'])) ? $errors['job'] : '' ; ?></span> 
                <input type="text" name="duties" id="" placeholder="Duties">
                <span class="error"><?php echo $error = (isset($errors['duties'])) ? $errors['duties'] : '' ; ?></span> 
                <div class="job_date">
                    <input type="text" name="start_date" id="" placeholder="Start Date" onfocus="(this.type='date')">
                    <span class="error"><?php echo $error = (isset($errors['sdate'])) ? $errors['sdate'] : '' ; ?></span> 
                    <input type="text" name="end_date" id="" placeholder="End Date" onfocus="(this.type='date')">
                    <span class="error"><?php echo $error = (isset($errors['edate'])) ? $errors['edate'] : '' ; ?></span> 
                </div>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div class="result">
        <?php if(isset($data)){ foreach ($data as $key => $value) {?>
            <h4><?php echo $key.': '.$value ?></h4>
        <?php }}?>
    </div>


</body>
</html>