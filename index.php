
 <?php

 $insert = false;
 $update = false;
 $delete = false;
 $username ="root";
$servername = "localhost";
$password ="";
$database ="notes";


$connection =mysqli_connect($servername,$username,$password,$database);
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sqldelete = "DELETE FROM `notess` WHERE `notess`.`S.no` = $sno";
  $rd = mysqli_query($connection,$sqldelete);
}
if($_SERVER['REQUEST_METHOD'] =='POST'){
  if(isset($_POST['SnoEdit'])){
    
    $Sno = $_POST["SnoEdit"];
    $title = $_POST["titleEdit"];
   
  $Description = $_POST["DescriptionEdit"];
  $sqlupdate = " UPDATE `notess` SET  `title` = '$title' ,`Description` = '$Description'   WHERE `notess`.`S.no` = $Sno ";
  $ru = mysqli_query($connection,$sqlupdate);
  if($ru){
    $update = true;
  }
 
  }
  else{
  $title = $_POST["title"];
  $Description = $_POST["Description"];
  $sqlinsert = "INSERT INTO `notess` ( `title`, `Description`) VALUES ( '$title', '$Description' )";
  $rs = mysqli_query($connection,$sqlinsert);
  if($rs){
    $insert = true;
  }
}
  }
?>

         
<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
         } );
    </script>
    <title>Note</title>
  </head>
  <body style="background-color: rgb(235, 230, 224);">
 
  
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModallabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/project/index.php" method = "post">
      <div class="modal-body">
  
      <input type="hidden" name="SnoEdit" id ="SnoEdit">
          
          <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp" name="titleEdit">
           
          </div>
          <div class="mb-3">
              <label for="Description" class="form-label"> Description</label>
              <textarea class="form-control" id="DescriptionEdit" rows="3" name="DescriptionEdit"></textarea>
            </div>
          
          
     
       
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="editmodal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

  

    <?php
   if($insert){
   echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Sucessfully!</strong> Added.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
   }
   if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Sucessfully!</strong> Updated.
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   </div>";
    }
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
       <strong>Sucessfully!</strong> Deleted.
       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
     </div>";
      }
  

  ?>
    
      <div class="container my-5">
          <h2>
              Add A Note
          </h2>
        <form action="/project/index.php" method = "post">
          
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="
            title" aria-describedby="emailHelp" name="title">
             
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label"> Description</label>
                <textarea class="form-control" id="Description" rows="3" name="Description"></textarea>
              </div>
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
      <div class="container">
       

<table class="table" id = "myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
          $sql = "SELECT * FROM `notess`";
          $result =mysqli_query($connection,$sql);
          $num = 1;
         while( $row =mysqli_fetch_assoc($result)){
           echo "<tr>
           <th scope='row'>".$num."</th>
           <td>".$row['title']."</td>
           <td>" . $row['description'] ."</td>
           <td> <button class='btn btn-sm btn-primary edit' id =" .$row['S.no'] .">Edit</button> <button class='btn btn-sm btn-primary delete' id =d" .$row['S.no'] .">Delete</button></td>
         </tr>";
         $num = $num +1;
          
          }
           
           
       ?>
    
    
  </tbody>
</table>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    

    <script>
         edits = document.getElementsByClassName('edit');
         Array.from(edits).forEach((element)=>{
           element.addEventListener("click",(e)=>{
             console.log("edit",);
             tr =e.target.parentNode.parentNode;
             title = tr.getElementsByTagName("td")[0].innerText;
             description =tr.getElementsByTagName("td")[1].innerText;
             console.log(title,description);
             DescriptionEdit.value = description;
             titleEdit.value = title;
             SnoEdit.value = e.target.id;
             console.log(e.target.id);
             $('#editModal').modal('toggle');
           })
         })



         deletes = document.getElementsByClassName('delete');
         Array.from(deletes).forEach((element)=>{
           element.addEventListener("click",(e)=>{
             console.log("edit",);
           sno = e.target.id.substr(1,);
           window.location = `/project/index.php?delete=${sno}`;

            if(confirm("Are you Sure!")){
              console.log("YES");
            }
            else{
              console.log("NO");
            }
             
           })
         })


         </script>
         <div class="foot " style="margin-top: 5vw;">
           <p class="ftex" style="text-align: center;">
             Created with 💖 By Aman
           </p>
         </div>
  </body>
  
</html>