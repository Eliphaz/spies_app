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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = strtolower($_POST['username']);
        $password = strtolower($_POST['password']);
        if (($username == 'chuck' && $password == 'roast') || ($username == 'bob' && $password == 'ross')) {
            echo '<h1>Access granted</h1>';
            if (isset($_POST['file_choice'])) {
                $file_choice = $_POST['file_choice'];
                $file_path = 'includes/' . $file_choice . '.txt';
                if (file_exists($file_path)) {
                    $file = fopen($file_path, 'r');
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
                    echo '<h1>File not found</h1>';
                }
            }
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="username" value="' . htmlspecialchars($username) . '">';
            echo '<input type="hidden" name="password" value="' . htmlspecialchars($password) . '">';
            echo '<button type="submit" name="file_choice" value="fbi" class="grey-button">View FBI File</button>';
            echo '<button type="submit" name="file_choice" value="spies" class="grey-button" style="margin-left: 10px;">View Spies File</button>';
            echo '</form>';
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