<!DOCTYPE html>
<html>
<head>
    <title>Notes App</title>
</head>
<body>
    <h1>My Notes App</h1>
    <form action="save.php" method="post">
        <textarea name="note" rows="5" cols="40"></textarea><br>
        <button type="submit">Save</button>
    </form>

    <h2>Saved Notes:</h2>
    <pre>
<?php
if (file_exists("/data/notes.txt")) {
    echo file_get_contents("/data/notes.txt");
} else {
    echo "No notes yet.";
}
?>
    </pre>
</body>
</html>

