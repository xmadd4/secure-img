<?php
///INCLUDE THE CONFIGURATION HERE///
if($_FILES["file"]["name"] != '')
{
 $file = explode('.', $_FILES["file"]["name"]);
  //array extention
 $ekstensi = array('png','jpg','jpeg','gif');
  //array mime type
 $mime = array('image/jpeg', 'image/gif', 'image/png', 'image/jpg');
  //check mime if file was uploaded
 $cek_mime = mime_content_type($_FILES["file"]["tmp_name"]);
  //check the content is image or not
 $cek_konten = file_get_contents($_FILES["file"]["tmp_name"]);
  //size
 $ukuran = $_FILES["file"]["size"];
 $ext = end($file);
 $name = md5(base64_encode(md5(sha1(rand(100,999))))) . '.' . $ext;
 $location = 'assets/img/' . $name;
 $sec = pathinfo($name, PATHINFO_EXTENSION);
///if in uploaded file detect <?php show the alert
if (preg_match('/(<\?php\s)/', $cek_konten))
{
  echo "<div class='alert alert-danger'>Heker Ya?,Blom Aja Ipnya Gw Banned</div>";
}
  //if in uploaded file mime type is text/html or etc show alert
elseif (!in_array($cek_mime, $mime)) 
{
  echo "<div class='alert alert-danger'>Invalid Tipe Mime!</div>";
}
  //check the extentsion
elseif(!in_array($sec,$ekstensi)) 
{
  echo "<div class='alert alert-danger'>File Yang Di Upload Bukan Gambar</div>";
}
  //check size
elseif ($ukuran > 1044070) 
{
 	echo "<div class='alert alert-danger'>Ukuran Gambar Terlalu Besar!</div>";
}
  //if image is valid,run the query
else 
{
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 mysqli_query($con,"UPDATE your table SET yourcolumn = '$location' WHERE id='session user'");
 echo "<div class='alert alert-success'>Gambar Terupload! , Silahkan Di Refresh</div>";
}
}
?>
