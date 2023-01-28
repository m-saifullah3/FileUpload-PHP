<?php

$error1 = $error = $name = '';

if (isset($_POST['submit'])) {
  if ($_FILES['file']['error'] != 0) {
    $error = 'Please attach your file!';
  } else {
    $file_name = $_FILES['file']['name'];
    $file_temp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_extension_array = explode('.', $file_name);
    $file_extension = strtolower(end($file_extension_array));
    $allowed_extensions = ['png', 'jpeg', 'jpg']; //** Extensions you want to allow the user to input **//
    if (in_array($file_extension, $allowed_extensions)) {
      if ($file_size < 10000000) { //** The maximum size of the files that can be uploaded **//
        $new_name = microtime(true) . "-" . $file_name;
        $upload_folder = 'Uploads/' . $new_name; //** The destination directory of the uploaded files **//
        if (move_uploaded_file($file_temp_name, $upload_folder)) {
          $error1 = 'File has been uploaded!';
        } else {
          $error = 'File has failed to upload!';
        }
      } else {
        $error = 'File is too big to be uploaded!';
      }
    } else {
      $error = 'File of this format is not allowed!';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

  <div class="container mt-5">
    <div class="row">
      <div class="col-4 mx-auto">
        <div class="card">
          <div class="card-body">
            <p class="text-danger"><?php echo $error; ?></p>
            <p class="text-success"><?php echo $error1; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
              <div class="mb-2">
                <label for="file">
                  <h4>File Upload</h4>
                </label>
                <input type="file" class="form-control" name="file" id="file" accept="image/*">
              </div>
              <input type="submit" class="btn btn-outline-primary" value="Submit" name="submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>