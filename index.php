<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    $showTable = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $username = strtolower($_POST['username']);
        $password = strtolower($_POST['password']);
        if (($username == 'chuck' && $password == 'roast') || ($username == 'bob' && $password == 'ross')) {
            echo '<h1>Access granted</h1>';
            $showTable = true;
            $file = fopen('includes/fbi.txt', 'r');
            echo '<table border="1">';
            echo '<tr><th>Agent</th><th>CodeName</th></tr>';
            while (($line = fgets($file)) !== false) {
                $entries = explode('||>><<||', $line);
                foreach ($entries as $entry) {
                    $columns = explode(',', $entry);
                    echo '<tr>';
                    foreach ($columns as $column) {
                        echo '<td>' . htmlspecialchars($column) . '</td>';
                    }
                    echo '</tr>';
                }
            }
            echo '</table>';
            fclose($file);
        } else {
            echo '<h1>Access denied</h1>';
        }
    }
    ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit" name="submit">Submit</button>
        <button type="reset" onclick="window.location.href=window.location.href">Reset</button>
    </form>
</body>
</html>