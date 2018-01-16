<html>
<style type="text/css">
  
input[type="file"] {
    border: 1px solid black;
    background-color: #e3d6d6;
}
table{

  margin: 0 auto;
    background-color: #bfcded;
    padding: 9%;
}

 
</style>

<body>
<form enctype="multipart/form-data"
  action="import.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  <table width="600">
  <tr>
  <td> Upload  It:</td>
  <td><input type="file" name="file" /></td>
  <td><input type="submit" value="Upload" /></td>
  </tr>
  </table>
  </form>
  </body>
  </html>