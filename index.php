<!DOCTYPE html>
<html>
<head>
    <title>New Notes App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 90%;
            background: #fff;
            margin: 40px 0;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            resize: vertical;
            min-height: 100px;
            margin-bottom: 12px;
        }

        button {
            align-self: flex-start;
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        h2 {
            color: #444;
            margin-bottom: 10px;
        }

        pre {
            background: #f9fafc;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            white-space: pre-wrap; 
            word-wrap: break-word; 
            font-size: 14px;
            line-height: 1.4;
            color: #222;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Brand New Notes App</h1>
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
    </div>
</body>
</html>
