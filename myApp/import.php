<?php require_once( "db.php" );
 
$data = array();
 

 
function add_person( $first, $middle, $last, $email )
{
 global $data, $db,$conn;
 
 $sql = "INSERT INTO names VALUES('id', '$first','$middle','$last','$email' )" ;


if ($conn->query($sql) === TRUE) {
    echo "<span>New record created successfully !!! '<br>''</span>  ";

} else {
    echo "Error: " . "<br>" . $conn->error;
}

 
 $data []= array(
   'first' => $first,
   'middle' => $middle,
   
   'last' => $last,
   'email' => $email
 );
}
 
if ( $_FILES['file']['tmp_name'] )
{
 $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
 $rows = $dom->getElementsByTagName( 'Row' );
 $first_row = true;
 foreach ($rows as $row)
 {
   if ( !$first_row )
   {
     $first = "";
     $middle = "";
     $last = "";
     $email = "";
 
     $index = 1;
     $cells = $row->getElementsByTagName( 'Cell' );
     foreach( $cells as $cell )
     {
       $ind = $cell->getAttribute( 'Index' );
       if ( $ind != null ) $index = $ind;
 
       if ( $index == 1 ) $first = $cell->nodeValue;
       if ( $index == 2 ) $middle = $cell->nodeValue;
       if ( $index == 3 ) $last = $cell->nodeValue;
       if ( $index == 4 ) $email = $cell->nodeValue;
 
       $index += 1;
     }
     add_person( $first, $middle, $last, $email );
   }
   $first_row = false;
 }

}




?>

<?php

$con=mysqli_connect("localhost","root","","myapp");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries 
$result = mysqli_query($con,"SELECT email  FROM names");



while($row = mysqli_fetch_array($result))
{
   $to = $row['email']; 
$subject = 'the subject';
$message = '<html>
<head>
  <title> Christmas Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html> ';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

}

mysqli_close($con);

?>




<html>

<style type="text/css">
 span {  text-align: center;
    font-size: 35px;
    color: #73e13a;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<body>


<table style="width:100%" >
<tr>
<th>First</th>
<th>Middle</th>
<th>Last</th>
<th>Email</th>
</tr>
<?php foreach( $data as $row ) { ?>
<tr>
<td><?php echo( $row['first'] ); ?></td>
<td><?php echo( $row['middle'] ); ?></td>
<td><?php echo( $row['last'] ); ?></td>
<td><?php echo( $row['email'] ); ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>