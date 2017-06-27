<?php
include_once('db.php');

if(isset($_POST["delete-all"]) && $_POST["delete-all"]=="Delete All") {
  $sql_delete_image = "DELETE FROM image";
  $conn->query($sql_delete_image);

  $sql_delete_image_tag = "DELETE FROM image_tag";
  $conn->query($sql_delete_image_tag);

  header('Location: index.php') ;
}

if(isset($_POST["delete"]) && $_POST["delete"]=="Delete") {

  if(isset($_POST["image_id"])) {
    $image_id = $_POST["image_id"];
  }

  if($image_id) {
  $sql_delete_image = "DELETE FROM image WHERE image_id = '".$image_id."'";
  $conn->query($sql_delete_image);

  $sql_delete_image_tag = "DELETE FROM image_tag WHERE image_id = '".$image_id."'";
  $conn->query($sql_delete_image_tag);
  header('Location: index.php') ;
  } else {
    echo "Opps! Not able to delete selected Image, Please Try Again!";
  }
}


if(isset($_POST["submit"]) && $_POST["submit"]=="ImageTags") {
//print_r($_POST); exit;
if(isset($_POST["image_id"])) {
  $image_id = $_POST["image_id"];
}

if($image_id) {
  if(isset($_POST["country"])) {
    $sql_country = "INSERT INTO image_tag SET image_id = '".$image_id."', name = 'country', value = '".$_POST["country"]."'";
    $conn->query($sql_country);
  }
  if(isset($_POST["type"])) {
    $sql_type = "INSERT INTO image_tag SET image_id = '".$image_id."', name = 'type', value = '".$_POST["type"]."'";
    $conn->query($sql_type);
  }
  if(isset($_POST["color"])) {
    $sql_color = "INSERT INTO image_tag SET image_id = '".$image_id."', name = 'color', value = '".$_POST["color"]."'";
    $conn->query($sql_color);
  }
  header('Location: index.php') ;
} else {
  echo "Something is Missing Please Try Again!!";
}
}

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 2500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $image = $_FILES["image"]["name"];
      $sql = "INSERT INTO image SET name = '".$image."', value = '".$image."'";

      if ($conn->query($sql) === TRUE) {
        $image_id = $conn->insert_id;
        echo "The image ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        ?>
        <div>
        <img src="images/<?php echo $image; ?>" class="form-image" height="80px" />
        </div>
        <h3> Please Add Tags for Your Uploaded Car Image.</h3>
        <form action="upload.php" method="post">
          <input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
        Country:
        <select name="country">
            <option value="">-- Select Country --</value>
            <option value="German">German</option>
            <option value="American">American</option>
            <option value="Japanese">Japanese</option>
            <option value="Other">Other</option>
        </select><br/><br/>
        Type:
        <select name="type">
            <option value="">-- Select Type --</value>
            <option value="SUV">SUV</option>
            <option value="Truck">Truck</option>
            <option value="Sedan">Sedan</option>
            <option value="Coupe">Coupe</option>
            <option value="Other">Other</option>
        </select><br/></br>
        Color:
        <select name="color">
            <option value="">-- Select Color --</option>
            <option value="Red">Red</option>
            <option value="Yellow">Yellow</option>
            <option value="Black">Black</option>
            <option value="White">White</option>
            <option value="Other">Other</option>
        </select><br/><br/>
        <input type="submit" value="ImageTags" name="submit">
        </form>

        <?php
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
