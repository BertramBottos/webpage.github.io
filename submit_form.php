 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $file = $_FILES['file'];

    $uploadDirectory = "uploads/";
    $uploadFilePath = $uploadDirectory . basename($file["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($uploadFilePath)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($file["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedTypes = array("jpg", "png", "pdf", "doc", "docx");
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, PNG, PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $uploadFilePath)) {
            echo "The file " . basename($file["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    echo "<h2>Form Details</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Address: $address</p>";
}
?>
