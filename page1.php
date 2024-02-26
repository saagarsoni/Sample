<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
</head>
<body>
    <h1>Page 1</h1>
    <form action="page2.php" method="post">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="id[]" value="1" readonly></td>
                    <td><input type="text" name="name[]" value="Product 1" readonly></td>
                    <td><input type="text" name="price[]" value="10" readonly></td>
                </tr>
                <tr>
                    <td><input type="text" name="id[]" value="2" readonly></td>
                    <td><input type="text" name="name[]" value="Product 2" readonly></td>
                    <td><input type="text" name="price[]" value="20" readonly></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <button type="submit" name="purchase">Make Purchase</button>
    </form>
</body>
</html>
