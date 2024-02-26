<!DOCTYPE html>
<html>
<head>
    <title>Insert Data</title>
</head>
<body>
    <h2>Insert Data into Database</h2>
    <form method="post">
        <table id="data_table">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
            <tr class="data_row">
                <td><input type="text" name="data[0][name]" required></td>
                <td><input type="number" name="data[0][age]" required></td>
                <td><input type="email" name="data[0][email]" required></td>
            </tr>
            <!-- Additional rows can be added dynamically using JavaScript -->
        </table>
        <button type="button" onclick="addRow()">Add Row</button>
        <input type="submit" name="submit" value="Submit">
    </form>

    <script>
        function addRow() {
            var table = document.getElementById("data_table");
            var newRow = table.insertRow(table.rows.length - 1); // Insert before the last row (submit button)
            var cells = [];
            for (var i = 0; i < 3; i++) {
                cells.push(newRow.insertCell(i));
            }
            cells[0].innerHTML = "<input type='text' name='data[" + (table.rows.length - 2) + "][name]' required>";
            cells[1].innerHTML = "<input type='number' name='data[" + (table.rows.length - 2) + "][age]' required>";
            cells[2].innerHTML = "<input type='email' name='data[" + (table.rows.length - 2) + "][email]' required>";
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Display submitted data in a table
        echo "<h2>Submitted Data</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Age</th><th>Email</th></tr>";
        foreach ($_POST['data'] as $key => $value) {
            $name = htmlspecialchars($_POST['data'][$key]['name']);
            $age = intval($_POST['data'][$key]['age']);
            $email = filter_var($_POST['data'][$key]['email'], FILTER_SANITIZE_EMAIL);

            echo "<tr><td>$name</td><td>$age</td><td>$email</td></tr>";
        }
        echo "</table>";

        // Provide option to confirm and insert data into database
        echo "<form method='post'>";
        echo "<input type='hidden' name='confirmed_data' value='".json_encode($_POST['data'])."'>";
        echo "<input type='submit' name='confirm' value='Confirm and Insert'>";
        echo "</form>";
    }

    if (isset($_POST['confirm'])) {
        $confirmed_data = json_decode($_POST['confirmed_data'], true);
        
        // Connect to database and insert data
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Loop through each row of the confirmed data and insert into database
        foreach ($confirmed_data as $key => $value) {
            $name = htmlspecialchars($value['name']);
            $age = intval($value['age']);
            $email = filter_var($value['email'], FILTER_SANITIZE_EMAIL);

            $sql = "INSERT INTO tblSample (name, age, email) VALUES ('$name', $age, '$email')";

            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        echo "Data inserted successfully";

        $conn->close();
    }
    ?>
</body>
</html>
