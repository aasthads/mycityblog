<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if(!empty($name) || !empty($email) || !empty($subject) || !empty($message) {
$host ="localhost";
$dbUsername = "root";
$dbPassword =" root";
$dbname ="mydatab";

$conn = newsqli($sql, $dbUsername, $dbPassword, $dbname);

if(mysqli_connect_error())
{
die('Connect Error('. mysqli_connect().')'. mysqli_connect_error());

} else {
$SELECT = "SELECT email From message where email = ? Limit 1";
$INSERT = "INSERT Into message (name, email, subject, message) values(?,?,?,?)";

$stmt = $conn->prepare($SELECT);
$stmt -> bind_param("s", $email);
$stmt ->execute();
$stmt -> bind_result($email);
$stmt -> store_result();
$rnum =$stmt ->num_rows;
 if($rnum == 0){
$stmt->close();
$stmt = $conn ->prepare($INSERT);
$stmt ->bind_param("ssssii",$name, $email, $subject, $message);
$stmt ->execute();
echo "new record inserted successfully";

} else
{
echo "someone else registered with same email";
}
$stmt->close();
$conn-> close();
}

} else {
echo "All feild are required";
die();
}

?>