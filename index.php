<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'swt_gaestebuch');

if($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $message = $_POST['message'];

    $sql = "INSERT INTO entries (name, message)VALUES ('" . $name . "', '" . $message . "')";

    $mysqli->query($sql);
}

$sql = "SELECT * FROM entries";
$entries_result = $mysqli->query($sql);


?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Gästebuch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        SWT Gästebuch
                    </div>
                    <div class="card-body">
                        <form method="POST" action="index.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Eintrag</label>
                                <textarea rows="7" name="message" class="form-control" id="message"></textarea>
                            </div>

                            <button class="btn btn-primary">Eintrag absenden</button>
                        </form>
                    </div>
                </div>

                <?php

                if ($entries_result->num_rows > 0) {
                    // output data of each row
                    while($row = $entries_result->fetch_assoc()) {
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-header'>";
                        echo $row["id"] . '. ' . $row["name"];
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo $row["message"];
                        echo "</div>";
                        echo "</div>";
                    }
                }

                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
