<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 2</title>
</head>
<body>
    <h1>Page 2</h1>
    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the "purchase" button was clicked
        if (isset($_POST["purchase"])) {
            // Check if any data was submitted
            if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["price"])) {
                // Process the submitted data
                echo "<p>Form data received:</p>";
                echo "<ul>";
                // Loop through each submitted item
                foreach ($_POST["id"] as $key => $id) {
                    $name = $_POST["name"][$key];
                    $price = $_POST["price"][$key];
                    echo "<li>ID: $id, Name: $name, Price: $price</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No data received from the form.</p>";
            }
        }
    }
    ?>
</body>
</html>
