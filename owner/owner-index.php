<?php 
session_start();
if(!isset($_SESSION["email"])){
  header("location:../index.php");
}

include("navbar.php");
include("engine.php");

 ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

 <div class="container-fluid">
  <ul class="nav nav-pills nav-justified">
    <li class="active" style="background-color: #FFF8DC"><a data-toggle="pill" href="#home">Profile</a></li>
    <!-- <li style="background-color: #FAC0E6"><a data-toggle="pill" href="#menu4">Messages</a></li> -->
    <li style="background-color: #FAF0E6"><a data-toggle="pill" href="#menu1">Add Property</a></li>
    <li style="background-color: #FFFACD"><a data-toggle="pill" href="#menu2">View Property</a></li>
    <li style="background-color: #FFFAF0"><a data-toggle="pill" href="#menu3">Update Property</a></li>
    <li style="background-color: #FAFAF0"><a data-toggle="pill" href="#menu6">Booked Property</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <center><h3>Owner Profile</h3></center>
      <div class="container">
      <?php 
        include("../config/config.php");
        $u_email= $_SESSION["email"];

        $sql="SELECT * from owner where email='$u_email'";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          
       ?>
        <div class="card">
  <img src="../images/avatar.png" alt="John" style="height:200px; width: 100%">
  <h1><?php echo $rows['full_name']; ?></h1>
  <p class="title"><?php echo $rows['email']; ?></p>
  <p><b>Phone No.: </b><?php echo $rows['phone_no']; ?></p>
  <p><b>Address: </b><?php echo $rows['address']; ?></p>
  <p><b>Id Type: </b><?php echo $rows['id_type']; ?></p>
  <p><img src="../<?php echo $rows['id_photo']; ?>" height="100px"></p>

  <!-- Trigger the modal with a button -->
  <p><button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Update Profile</button></p>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Profile</h4>
        </div>
        <div class="modal-body">

            <form method="POST">
                <div class="form-group">
                  <label for="full_name">Full Name:</label>
                  <input type="hidden" value="<?php echo $rows['owner_id']; ?>" name="owner_id">
                  <input type="text" class="form-control" id="full_name" value="<?php echo $rows['full_name']; ?>" name="full_name">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" value="<?php echo $rows['email']; ?>" name="email" readonly>
                </div>
                <div class="form-group">
                  <label for="phone_no">Phone No.:</label>
                  <input type="text" class="form-control" id="phone_no" value="<?php echo $rows['phone_no']; ?>" name="phone_no">
                </div>
                <div class="form-group">
                  <label for="address">Address:</label>
                  <input type="text" class="form-control" id="address" value="<?php echo $rows['address']; ?>" name="address">
                </div>
                <div class="form-group">
      <label for="id_type">Type of ID:</label>
      <input type="text" class="form-control" value="<?php echo $rows['id_type']; ?>" name="id_type" readonly>
    </div>
    <div class="form-group">
      <label>Your Id:</label><br>
      <img src="../<?php echo $rows['id_photo']; ?>" id="output_image"/ height="100px" readonly>
    </div>
                <hr>
                <center><button id="submit" name="owner_update" class="btn btn-primary btn-block">Update</button></center><br>
                
              </form>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
    </div>
    </div>




  <?php
  }
  
  }?>

    <div id="menu1" class="tab-pane fade">
      <center><h3>Add Property</h3></center>
      <div class="container">

      
<div id="map_canvas"></div>
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
              <label for="country">Country:</label>
              <select class="form-control" name="country" required="required">
                                <option value="">--Select Country--</option>
                                <option value="India">India</option>
              </select>
            </div>
            <div class="form-group">
              <label for="province">State:</label>
              <select class="form-control" name="province" required="required">
                                <option value="">--Select State--</option>
                                <option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
              </select>
            </div>
            <div class="form-group">
              <label for="zone">Zone:</label>
              <select class="form-control" name="zone" required="required">
                                <option value="">--Select Zone--</option>
                                <option value="North Zone">North Zone</option>
    <option value="South Zone">South Zone</option>
    <option value="East Zone">East Zone</option>
    <option value="West Zone">West Zone</option>
                            </select>
            </div>
            <div class="form-group">
              <label for="district">District:</label>
              <select class="form-control" name="district" required="required">
                                %{--Maharashtra--}%
                                <option value="">--Select District--</option>
                                <option value="Mumbai City">Mumbai City</option>
    <option value="Pune">Pune</option>
    <option value="Nagpur">Nagpur</option>
    <option value="Nashik">Nashik</option>
    <option value="Thane">Thane</option>
    <option value="Aurangabad">Aurangabad</option>
    <option value="Solapur">Solapur</option>
    <option value="Jalgaon">Jalgaon</option>
    <option value="Kolhapur">Kolhapur</option>
    <option value="Satara">Satara</option>
                                %{--Kerala--}%
                                <option value="Alappuzha">Alappuzha</option>
    <option value="Ernakulam">Ernakulam</option>
    <option value="Idukki">Idukki</option>
    <option value="Kottayam">Kottayam</option>
    <option value="Kozhikode">Kozhikode</option>
                               
                            </select>
            </div>
            <div class="form-group">
              <label for="city">City:</label>
              <input type="text" class="form-control" id="city" placeholder="Enter City" name="city">
            </div>
            <div class="form-group">
              <label for="vdc/municipality">VDC/Municipality:</label>
              <select class="form-control" name="vdc_municipality">
                <option value="">--Select VDC/Municipality--</option>
                <option value="VDC">VDC</option>
                <option value="Municipality">Municipality</option>
              </select>

            </div>
            <div class="form-group">
              <label for="ward_no">Ward No.:</label>
              <input type="text" class="form-control" id="ward_no" placeholder="Enter Ward No." name="ward_no">
            </div>
            <div class="form-group">
              <label for="tole">Tole:</label>
              <input type="text" class="form-control" id="tole" placeholder="Enter Tole" name="tole">
            </div>
            <div class="form-group">
              <label for="contact_no">Contact No.:</label>
              <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact No." name="contact_no">
            </div>
            <div class="form-group">
               <label for="property_type">Property Type:</label>
                <select class="form-control" name="property_type">
                      <option value="">--Select Property Type--</option>
                      <option value="Full House Rent">Full House Rent</option>
                      <option value="Flat Rent">Flat Rent</option>
                      <option value="Room Rent">Room Rent</option>
                </select>
            </div>                      
            <div class="form-group">
                <label for="estimated_price">Estimated Price:</label>
                <input type="estimated_price" class="form-control" id="estimated_price" placeholder="Enter Estimated Price" name="estimated_price">
            </div>
        </div>

        <div class="col-sm-6">
                  <div class="form-group">
                    <label for="total_rooms">Total No. of Rooms:</label>
                    <input type="number" class="form-control" id="total_rooms" placeholder="Enter Total No. of Rooms" name="total_rooms">
                  </div>
                  <div class="form-group">
                    <label for="bedroom">No. of Bedroom:</label>
                    <input type="number" class="form-control" id="bedroom" placeholder="Enter No. of Bedroom" name="bedroom">
                  </div>
                  <div class="form-group">
                    <label for="living_room">No. of Living Room:</label>
                    <input type="number" class="form-control" id="living_room" placeholder="Enter No. of Living Room" name="living_room">
                  </div>
                  <div class="form-group">
                    <label for="kitchen">No. of Kitchen:</label>
                    <input type="number" class="form-control" id="kitchen" placeholder="Enter No. of Kitchen" name="kitchen">
                  </div>
                  <div class="form-group">
                    <label for="bathroom">No. of Bathroom/Washroom:</label>
                    <input type="number" class="form-control" id="bathroom" placeholder="Enter No. of Bathroom/Washroom" name="bathroom">
                  </div>
                  <div class="form-group">
                    <label for="description">Full Description:</label>
                    <textarea type="comment" class="form-control" id="description" placeholder="Enter Property Description" name="description"></textarea>
                  </div>
                  <table class="table table-bordered" border="0">  
                  <tr> 
                    <div class="form-group"> 
                    <label><b>Latitude/Longitude:</b><span style="color:red; font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Click on Button</span></label>                    
                    <td><input type="text" name="latitude" placeholder="Latitude" id="latitude" class="form-control name_list" readonly required /></td>
                    <td><input type="text" name="longitude" placeholder="Longitude" id="longitude" class="form-control name_list" readonly required /></td> 
                    <td><input type="button" value="Get Latitude and Longitude" onclick="getLocation()" class="btn btn-success col-lg-12"></td>  
                  </div>
                  </tr>  
                </table>
                  <table class="table" id="dynamic_field">  
                  <tr> 
                    <div class="form-group"> 
                    <label><b>Photos:</b></label>                    
                    <td><input type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td> 
                    <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>  
                  </div>
                  </tr>  
                </table>
                <input name="lat" type="text" id="lat" hidden>
                <input name="lng" type="text" id="lng" hidden>
                  <hr>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Add Property" name="add_property">
                  </div>
                </div>
              </div>
              </form>
              <br><br>

    </div>
    </div>


    <div id="menu2" class="tab-pane fade">
      <center><h3>View Property</h3></center>
      <div class="container-fluid">
      <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name">
            <div style="overflow-x:auto;">
              <table id="myTable">
                <tr class="header">
                  <th>Id.</th>
                  <th>Country</th>
                  <th>Province/State</th>
                  <th>Zone</th>
                  <th>District</th>
                  <th>City</th>
                  <th>VDC/Municipality</th>
                  <th>Ward No.</th>
                  <th>Tole</th>
                  <th>Contact No.</th>
                  <th>Property Type</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Estmated Price</th>
                  <th>Total Rooms</th>
                  <th>Bedroom</th>
                  <th>Living Room</th>
                  <th>Kitchen</th>
                  <th>Bathroom</th>
                  <th>Description</th>
                  <th>Photos</th>
                </tr>
                <?php 
                $u_email=$_SESSION['email'];
        $sql1="SELECT * from owner where email='$u_email'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($rowss=mysqli_fetch_assoc($result1)){
            $owner_id=$rowss['owner_id'];

        $sql="SELECT * from add_property where owner_id='$owner_id'";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          $property_id=$rows['property_id'];
       ?>
                <tr>
                  <td><?php echo $rows['property_id'] ?></td>
                  <td><?php echo $rows['country'] ?></td>
                  <td><?php echo $rows['province'] ?></td>
                  <td><?php echo $rows['zone'] ?></td>
                  <td><?php echo $rows['district'] ?></td>
                  <td><?php echo $rows['city'] ?></td>
                  <td><?php echo $rows['vdc_municipality'] ?></td>
                  <td><?php echo $rows['ward_no'] ?></td>
                  <td><?php echo $rows['tole'] ?></td>
                  <td><?php echo $rows['contact_no'] ?></td>
                  <td><?php echo $rows['property_type'] ?></td>
                  <td><?php echo $rows['latitude'] ?></td>
                  <td><?php echo $rows['longitude'] ?></td>
                  <td>Rs.<?php echo $rows['estimated_price'] ?></td>
                  <td><?php echo $rows['total_rooms'] ?></td>
                  <td><?php echo $rows['bedroom'] ?></td>
                  <td><?php echo $rows['living_room'] ?></td>
                  <td><?php echo $rows['kitchen'] ?></td>
                  <td><?php echo $rows['bathroom'] ?></td>
                  <td><?php echo $rows['description'] ?></td><td>
<?php $sql2="SELECT * from property_photo where property_id='$property_id'";
        $query=mysqli_query($db,$sql2);

        if(mysqli_num_rows($query)>0)
      {
          while($row=mysqli_fetch_assoc($query)){ ?>
                  <img src="<?php echo $row['p_photo'] ?>" width="50px">
                <?php }}}}}} ?>
                </td>
                </tr>
              </table> 
            </div>
    </div>
    </div>

    <div id="menu3" class="tab-pane fade">
    <center><h3>Update Property</h3></center>
    <div class="container-fluid">
        <input type="text" id="myInput" onkeyup="updateProperty()" placeholder="Search..." title="Type in a name">
        <div style="overflow-x:auto;">
            <table id="myTable">
                <tr class="header">
                  <th>Id.</th>
                  <th>Country</th>
                  <th>Province/State</th>
                  <th>Zone</th>
                  <th>District</th>
                  <th>City</th>
                  <th>VDC/Municipality</th>
                  <th>Ward No.</th>
                  <th>Tole</th>
                  <th>Contact No.</th>
                  <th>Property Type</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Estmated Price</th>
                  <th>Total Rooms</th>
                  <th>Bedroom</th>
                  <th>Living Room</th>
                  <th>Kitchen</th>
                  <th>Bathroom</th>
                  <th>Description</th>
                  <th>Photos</th>
                  <th>Edit/Delete</th>
                </tr>
                <?php 
                $sql="SELECT * from add_property where owner_id='$owner_id'";
                $result=mysqli_query($db,$sql);

                if(mysqli_num_rows($result)>0) {
                    while($rows=mysqli_fetch_assoc($result)){
                        $property_id=$rows['property_id'];
                ?>
                <tr>
                  <td><?php echo $rows['property_id'] ?></td>
                  <td><?php echo $rows['country'] ?></td>
                  <td><?php echo $rows['province'] ?></td>
                  <td><?php echo $rows['zone'] ?></td>
                  <td><?php echo $rows['district'] ?></td>
                  <td><?php echo $rows['city'] ?></td>
                  <td><?php echo $rows['vdc_municipality'] ?></td>
                  <td><?php echo $rows['ward_no'] ?></td>
                  <td><?php echo $rows['tole'] ?></td>
                  <td><?php echo $rows['contact_no'] ?></td>
                  <td><?php echo $rows['property_type'] ?></td>
                  <td><?php echo $rows['latitude'] ?></td>
                  <td><?php echo $rows['longitude'] ?></td>
                  <td>Rs.<?php echo $rows['estimated_price'] ?></td>
                  <td><?php echo $rows['total_rooms'] ?></td>
                  <td><?php echo $rows['bedroom'] ?></td>
                  <td><?php echo $rows['living_room'] ?></td>
                  <td><?php echo $rows['kitchen'] ?></td>
                  <td><?php echo $rows['bathroom'] ?></td>
                  <td><?php echo $rows['description'] ?></td>
                  <td>
                  <?php 
                  $sql2="SELECT * from property_photo where property_id='$property_id'";
                  $query=mysqli_query($db,$sql2);
                  if(mysqli_num_rows($query)>0) {
                      while($row=mysqli_fetch_assoc($query)) { 
                  ?>
                      <img src="<?php echo $row['p_photo'] ?>" width="50px">
                  <?php }} ?>
                  </td>
                  <td>
                      <form method="POST" style="display:inline;">
                          <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($rows['property_id']); ?>">
                          <a data-toggle="pill" class="btn btn-success" name="edit_property" 
                             href="#menu5?edit_id=<?php echo $rows['property_id']; ?>">Edit</a>
                          <input type="submit" class="btn btn-danger" name="delete_property" value="Delete" 
                                 onclick="return confirm('Are you sure you want to delete this property?');">
                      </form>
                    </td>
                </tr>
                
                </form>
                <?php }} ?>
              </table> 
            </div>
    </div>
    </div>


    <?php
// Handle Delete Action
if(isset($_POST['delete_property'])) {
    $property_id = mysqli_real_escape_string($db, $_POST['property_id']);
    
    // First delete associated photos
    $delete_photos = "DELETE FROM property_photo WHERE property_id = '$property_id'";
    mysqli_query($db, $delete_photos);
    
    // Then delete the property
    $delete_property = "DELETE FROM add_property WHERE property_id = '$property_id' AND owner_id = '$owner_id'";
    $result = mysqli_query($db, $delete_property);
    
    if($result) {
        echo "<script>alert('Property deleted successfully'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error deleting property');</script>";
    }
}

// Handle Edit Action - Load property data when edit is clicked
$edit_data = null;
if(isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($db, $_GET['edit_id']);
    $edit_query = "SELECT * FROM add_property WHERE property_id = '$edit_id' AND owner_id = '$owner_id'";
    $edit_result = mysqli_query($db, $edit_query);
    $edit_data = mysqli_fetch_assoc($edit_result);
}

// Handle Update Action
if(isset($_POST['update_property'])) {
    $property_id = mysqli_real_escape_string($db, $_POST['property_id']);
    
    // Collect all form data
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $province = mysqli_real_escape_string($db, $_POST['province']);
    $zone = mysqli_real_escape_string($db, $_POST['zone']);
    $district = mysqli_real_escape_string($db, $_POST['district']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $vdc_municipality = mysqli_real_escape_string($db, $_POST['vdc_municipality']);
    $ward_no = mysqli_real_escape_string($db, $_POST['ward_no']);
    $tole = mysqli_real_escape_string($db, $_POST['tole']);
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $property_type = mysqli_real_escape_string($db, $_POST['property_type']);
    $estimated_price = mysqli_real_escape_string($db, $_POST['estimated_price']);
    $total_rooms = mysqli_real_escape_string($db, $_POST['total_rooms']);
    $bedroom = mysqli_real_escape_string($db, $_POST['bedroom']);
    $living_room = mysqli_real_escape_string($db, $_POST['living_room']);
    $kitchen = mysqli_real_escape_string($db, $_POST['kitchen']);
    $bathroom = mysqli_real_escape_string($db, $_POST['bathroom']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    
    // Update query
    $update_query = "UPDATE add_property SET 
                    country = '$country',
                    province = '$province',
                    zone = '$zone',
                    district = '$district',
                    city = '$city',
                    vdc_municipality = '$vdc_municipality',
                    ward_no = '$ward_no',
                    tole = '$tole',
                    contact_no = '$contact_no',
                    property_type = '$property_type',
                    estimated_price = '$estimated_price',
                    total_rooms = '$total_rooms',
                    bedroom = '$bedroom',
                    living_room = '$living_room',
                    kitchen = '$kitchen',
                    bathroom = '$bathroom',
                    description = '$description'
                    WHERE property_id = '$property_id' AND owner_id = '$owner_id'";
    
    $result = mysqli_query($db, $update_query);
    
    // Handle file uploads
    if(!empty($_FILES['photos']['name'][0])) {
        foreach($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $photo_name = $_FILES['photos']['name'][$key];
            $photo_tmp = $_FILES['photos']['tmp_name'][$key];
            $upload_dir = "uploads/"; // Your upload directory
            
            if(move_uploaded_file($photo_tmp, $upload_dir.$photo_name)) {
                $insert_photo = "INSERT INTO property_photo (property_id, p_photo) 
                               VALUES ('$property_id', '$photo_name')";
                mysqli_query($db, $insert_photo);
            }
        }
    }
    
    if($result) {
        echo "<script>alert('Property updated successfully'); window.location.href='#menu3';</script>";
    } else {
        echo "<script>alert('Error updating property');</script>";
    }
}
?>

<div id="menu5" class="tab-pane fade">
    <center><h3>Edit Property Details</h3></center>
    <div class="container">
        <div id="map_canvas"></div>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="property_id" value="<?php echo isset($edit_data['property_id']) ? $edit_data['property_id'] : ''; ?>">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Left Column Fields -->
                    <div class="form-group">
    <label for="country">Country:</label>
    <select class="form-control" name="country" required>
        <option value="">--Select Country--</option>
        <option value="india" <?php echo (isset($edit_data['country']) && $edit_data['country'] == 'india') ? 'selected' : ''; ?>>India</option>
    </select>
</div>
                    
<div class="form-group">
    <label for="province">State:</label>
    <select class="form-control" name="province" required>
        <option value="">--Select State--</option>
        <option value="Kerala" <?php echo (isset($edit_data['province']) && $edit_data['province'] == 'Kerala') ? 'selected' : ''; ?>>Kerala</option>
        <option value="Madhya Pradesh" <?php echo (isset($edit_data['province']) && $edit_data['province'] == 'Madhya Pradesh') ? 'selected' : ''; ?>>Madhya Pradesh</option>
        <option value="Maharashtra" <?php echo (isset($edit_data['province']) && $edit_data['province'] == 'Maharashtra') ? 'selected' : ''; ?>>Maharashtra</option>
        <option value="Manipur" <?php echo (isset($edit_data['province']) && $edit_data['province'] == 'Manipur') ? 'selected' : ''; ?>>Manipur</option>
        <option value="Meghalaya" <?php echo (isset($edit_data['province']) && $edit_data['province'] == 'Meghalaya') ? 'selected' : ''; ?>>Meghalaya</option>
    </select>
</div>
                    
<div class="form-group">
    <label for="zone">Zone:</label>
    <select class="form-control" name="zone" required>
        <option value="">--Select Zone--</option>
        <option value="North Zone" <?php echo (isset($edit_data['zone']) && $edit_data['zone'] == 'North Zone') ? 'selected' : ''; ?>>North Zone</option>
        <option value="South Zone" <?php echo (isset($edit_data['zone']) && $edit_data['zone'] == 'South Zone') ? 'selected' : ''; ?>>South Zone</option>
        <option value="East Zone" <?php echo (isset($edit_data['zone']) && $edit_data['zone'] == 'East Zone') ? 'selected' : ''; ?>>East Zone</option>
        <option value="West Zone" <?php echo (isset($edit_data['zone']) && $edit_data['zone'] == 'West Zone') ? 'selected' : ''; ?>>West Zone</option>
    </select>
</div>

            <div class="form-group">
            <label for="district">District:</label>
              <select class="form-control" name="district" required="required">
                                %{--Maharashtra--}%
                                <option value="">--Select District--</option>
                                <option value="Mumbai City">Mumbai City</option>
    <option value="Pune">Pune</option>
    <option value="Nagpur">Nagpur</option>
    <option value="Nashik">Nashik</option>
    <option value="Thane">Thane</option>
    <option value="Aurangabad">Aurangabad</option>
    <option value="Solapur">Solapur</option>
    <option value="Jalgaon">Jalgaon</option>
    <option value="Kolhapur">Kolhapur</option>
    <option value="Satara">Satara</option>
                                %{--Kerala--}%
                                <option value="Alappuzha">Alappuzha</option>
    <option value="Ernakulam">Ernakulam</option>
    <option value="Idukki">Idukki</option>
    <option value="Kottayam">Kottayam</option>
    <option value="Kozhikode">Kozhikode</option>
                               
                            </select>
            </div>
            <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" 
                               value="<?php echo isset($edit_data['city']) ? htmlspecialchars($edit_data['city']) : ''; ?>">
                    </div>
            <div class="form-group">
              <label for="vdc/municipality">VDC/Municipality:</label>
              <select class="form-control" name="vdc_municipality">
                <option value="">--Select VDC/Municipality--</option>
                <option value="VDC">VDC</option>
                <option value="Municipality">Municipality</option>
              </select>

            </div>
            <div class="form-group">
              <label for="ward_no">Ward No.:</label>
              <input type="text" class="form-control" id="ward_no" placeholder="Enter Ward No." name="ward_no">
            </div>
            <div class="form-group">
              <label for="tole">Tole:</label>
              <input type="text" class="form-control" id="tole" placeholder="Enter Tole" name="tole">
            </div>
            <div class="form-group">
              <label for="contact_no">Contact No.:</label>
              <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact No." name="contact_no">
            </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group">
    <label for="property_type">Property Type:</label>
    <select class="form-control" name="property_type" required>
        <option value="">--Select Property Type--</option>
        <option value="Full House Rent" <?php echo (isset($edit_data['property_type']) && $edit_data['property_type'] == 'Full House Rent') ? 'selected' : ''; ?>>Full House Rent</option>
        <option value="Flat Rent" <?php echo (isset($edit_data['property_type']) && $edit_data['property_type'] == 'Flat Rent') ? 'selected' : ''; ?>>Flat Rent</option>
        <option value="Room Rent" <?php echo (isset($edit_data['property_type']) && $edit_data['property_type'] == 'Room Rent') ? 'selected' : ''; ?>>Room Rent</option>
    </select>
</div>                 
                    <div class="form-group">
                        <label for="estimated_price">Estimated Price:</label>
                        <input type="text" class="form-control" name="estimated_price" 
                               value="<?php echo isset($edit_data['estimated_price']) ? htmlspecialchars($edit_data['estimated_price']) : ''; ?>" required>
                    </div>
                  <div class="form-group">
                    <label for="total_rooms">Total No. of Rooms:</label>
                    <input type="number" class="form-control" id="total_rooms" placeholder="Enter Total No. of Rooms" name="total_rooms">
                  </div>
                  <div class="form-group">
                    <label for="bedroom">No. of Bedroom:</label>
                    <input type="number" class="form-control" id="bedroom" placeholder="Enter No. of Bedroom" name="bedroom">
                  </div>
                  <div class="form-group">
                    <label for="living_room">No. of Living Room:</label>
                    <input type="number" class="form-control" id="living_room" placeholder="Enter No. of Living Room" name="living_room">
                  </div>
                  <div class="form-group">
                    <label for="kitchen">No. of Kitchen:</label>
                    <input type="number" class="form-control" id="kitchen" placeholder="Enter No. of Kitchen" name="kitchen">
                  </div>
                  <div class="form-group">
                    <label for="bathroom">No. of Bathroom/Washroom:</label>
                    <input type="number" class="form-control" id="bathroom" placeholder="Enter No. of Bathroom/Washroom" name="bathroom">
                  </div>
                  <div class="form-group">
                        <label for="description">Full Description:</label>
                        <textarea class="form-control" id="description" placeholder="Enter Property Description" name="description"><?php echo isset($edit_data['description']) ? htmlspecialchars($edit_data['description']) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Photos:</label><br>
                        <?php 
                        if(isset($edit_data['property_id'])) {
                            $photo_query = "SELECT * FROM property_photo WHERE property_id = '".$edit_data['property_id']."'";
                            $photo_result = mysqli_query($db, $photo_query);
                            while($photo = mysqli_fetch_assoc($photo_result)) {
                                echo '<img src="'.$photo['p_photo'].'" width="50" style="margin-right:5px;">';
                            }
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Add More Photos:</label>
                        <input type="file" name="photos[]" multiple class="form-control">
                    </div>
                  <hr>
                  <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Update Property" name="update_property">
                    </div>
              </div>
              </form>
              <br><br>

    </div>
    </div>

<div id="menu6" class="tab-pane fade">
      <center><h3>Booked Property</h3></center>
      <div class="container">
        <input type="text" id="myInput" onkeyup="bookedProperty()" placeholder="Search..." title="Type in a name">

              <table id="myTable">
                <tr class="header">
                  <th>Booked By</th>
                  <th>Booker Address</th>
                  <th>Property Province</th>
                  <th>Property District</th>
                  <th>Property Zone</th>
                  <th>Property Ward No</th>
                  <th>Property Tole</th>
                </tr>

      <?php 
        include("../config/config.php");
            $u_email= $_SESSION["email"];

        $sql3="SELECT * from owner where email='$u_email'";
            $result3=mysqli_query($db,$sql3);

            if(mysqli_num_rows($result3)>0)
          {
              while($rowss=mysqli_fetch_assoc($result3)){
                $owner_id=$rowss['owner_id'];

                $sql2="SELECT * from add_property where owner_id='$owner_id'";
        $result2=mysqli_query($db,$sql2);

        if(mysqli_num_rows($result2)>0)
      {
          while($ro=mysqli_fetch_assoc($result2)){
            $property_id=$ro['property_id'];

        $sql="SELECT * from booking where property_id='$property_id'";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          
       ?>
                <tr>
                  
        <?php 
        $tenant_id=$rows['tenant_id'];
        $property_id=$rows['property_id'];
        $sql1="SELECT * from tenant where tenant_id='$tenant_id'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($row=mysqli_fetch_assoc($result1)){
          
       ?>


        <td><?php echo $row['full_name']; ?></td>
        <td><?php echo $row['address']; ?></td>



                  <td><?php echo $ro['province']; ?></td>
                  <td><?php echo $ro['district']; ?></td>
                  <td><?php echo $ro['zone']; ?></td>
                  <td><?php echo $ro['ward_no']; ?></td>
                  <td><?php echo $ro['tole']; ?></td>
                </tr>
              <?php }}}}}}}} ?>
              </table> 
    </div>
    </div>

  </div>
</div>
</body>




<script>
              function viewProperty() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                th = table.getElementsByTagName("th");
                for (i = 1; i < tr.length; i++) {
                  tr[i].style.display = "none";
                    for(var j=0; j<th.length; j++){
                      td = tr[i].getElementsByTagName("td")[j];      
                      if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
                        {
                          tr[i].style.display = "";
                          break;
                         }
                      }
                    }
                }
              }
              </script>
<script>
              function updateProperty() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                th = table.getElementsByTagName("th");
                for (i = 1; i < tr.length; i++) {
                  tr[i].style.display = "none";
                    for(var j=0; j<th.length; j++){
                      td = tr[i].getElementsByTagName("td")[j];      
                      if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
                        {
                          tr[i].style.display = "";
                          break;
                         }
                      }
                    }
                }
              }
              </script>
              <script>
              function bookedProperty() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                th = table.getElementsByTagName("th");
                for (i = 1; i < tr.length; i++) {
                  tr[i].style.display = "none";
                    for(var j=0; j<th.length; j++){
                      td = tr[i].getElementsByTagName("td")[j];      
                      if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
                        {
                          tr[i].style.display = "";
                          break;
                         }
                      }
                    }
                }
              }
              </script>
              <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td></td> <td><button id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 
      });  

                 



      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>



 <script>
   if (status == google.maps.GeocoderStatus.OK) {
    map.setCenter(results[0].geometry.location);
    var marker = new google.maps.Marker;
    document.getElementById('lat').value = results[0].geometry.location.lat();
    document.getElementById('lng').value = results[0].geometry.location.lng();

    var latt=results[0].geometry.location.lat();
    var lngg=results[0].geometry.location.lng();
    $.ajax({
        url: "your-php-code-url-to-save-in-database",
        dataType: 'json',
        type: 'POST',
        data:{ lat: lat, lng: lngg }
        success: function(data)
        {                
           //check here whether inserted or not 
        }
   });


 }
 </script>


 <script>
  //For Latitude and Longitude
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    document.getElementById("latitude").value = "Geolocation is not supported by this browser.";
    document.getElementById("longitude").value = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
}
</script>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>