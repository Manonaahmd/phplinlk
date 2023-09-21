<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "studenntss";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successfully established!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $sql = "SELECT * FROM `phone index`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if (!empty($rows)) {
    echo "<table class=`phone index`>";
    echo "<thead><tr><th>Full Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Comments</th><th>fax</th></tr></thead>";
    echo "<tbody>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row["FullName"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Address"] . "</td>";
        echo "<td>" . $row["Comments"] . "</td>";
        echo "<td>" . $row["fax"] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No records found in the users table.";
}

$conn = null;
?>