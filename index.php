<!DOCTYPE html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<html>
<?php include_once('db.php'); ?>
<body>
<div class="container">
<h2><a href="index.php">Applied Imagination</a></h2>
<div class="form-container">
<form action="upload.php" method="post" enctype="multipart/form-data" class="form-upload">
    Upload Your Image :
    <input type="file" name="image" id="image">
    <input type="submit" value="Upload Image" name="submit">
</form>
<form action="upload.php" method="post" enctype="multipart/form-data" class="form-delete">
    <input type="submit" value="Delete All" name="delete-all">
</form>
</div>
<div class="image-grid">
<div class="filter">
  <select name="color" id="filter-color">
      <option value="">-- Filter By Color --</option>
      <option value="">View All</option>
      <option value="Red">Red</option>
      <option value="Yellow">Yellow</option>
      <option value="Black">Black</option>
      <option value="White">White</option>
      <option value="Other">Other</option>
  </select>
  <select name="type" id="filter-type">
      <option value="">-- Filter By Type --</value>
      <option value="">View All</option>
      <option value="SUV">SUV</option>
      <option value="Truck">Truck</option>
      <option value="Sedan">Sedan</option>
      <option value="Coupe">Coupe</option>
      <option value="Other">Other</option>
  </select>
  <select name="country" id="filter-country">
      <option value="">-- Filter By Country --</value>
      <option value="">View All</option>
      <option value="German">German</option>
      <option value="American">American</option>
      <option value="Japanese">Japanese</option>
      <option value="Other">Other</option>
  </select>
  <a href="index.php" class="reset-link">Reset Filters</a>
</div>
<?php
$sql = "SELECT i.image_id, i.name, i.value FROM image i";
if(isset($_GET["country"]) || isset($_GET["type"]) || isset($_GET["color"])) {
  $sql .= " LEFT JOIN image_tag it ON (i.image_id = it.image_id)";
  if(isset($_GET["country"])) {
    $sql .= " WHERE it.value = '".$_GET["country"]."'";
  }
  if(isset($_GET["type"])) {
    $sql .= " WHERE it.value = '".$_GET["type"]."'";
  }
  if(isset($_GET["color"])) {
    $sql .= " WHERE it.value = '".$_GET["color"]."'";
  }
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='column'>";
        echo "<img src='images/".$row["value"]."' />";
        echo "<div class='heading'>". $row["image_id"]. " -  " . $row["name"]. "</div>";
        ?>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="form-delete">
            <input type="hidden" name="image_id" value="<?php echo $row["image_id"]; ?>">
            <input type="submit" value="Delete" name="delete">
        </form>
        <?php
        $sql_tag = "SELECT * FROM image_tag WHERE image_id = '".$row["image_id"]."'";
        $result_tag = $conn->query($sql_tag);
        if ($result_tag->num_rows > 0) {
          while($row_tag = $result_tag->fetch_assoc()) {
            echo "<span class='tag'>".ucwords($row_tag["name"]).": ".$row_tag["value"]."</span>";
          }
        }
        echo "</div>";
    }
} else {
    echo "No Images Available Yet!!";
} ?>
</div>
</div>
<script>
document.getElementById('filter-country').onchange = function() {
    if(this.value.length == 0) {
      window.location = "index.php";
    } else {
      window.location = "index.php?country=" + this.value;
    }
};
document.getElementById('filter-type').onchange = function() {
    if(this.value.length == 0) {
      window.location = "index.php";
    } else {
    window.location = "index.php?type=" + this.value;
    }
};
document.getElementById('filter-color').onchange = function() {
    if(this.value.length == 0) {
      window.location = "index.php";
    } else {
    window.location = "index.php?color=" + this.value;
    }
};
</script>
</body>
</html>
