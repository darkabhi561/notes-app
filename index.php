<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevOps Batch 17 Notes</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #141e30, #243b55);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 90vh;
      color: #fff;
    }

    .app {
      width: 90%;
      max-width: 750px;
      padding: 25px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      animation: slideUp 1s ease;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 20px;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 25px;
    }

    textarea {
      background: rgba(255,255,255,0.1);
      border: none;
      border-radius: 12px;
      padding: 15px;
      color: #fff;
      font-size: 15px;
      resize: vertical;
      min-height: 120px;
      outline: none;
      transition: 0.3s;
    }

    textarea:focus {
      background: rgba(255,255,255,0.15);
      box-shadow: 0 0 8px rgba(0,198,255,0.6);
    }

    button {
      align-self: flex-start;
      padding: 12px 24px;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      color: #fff;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      transition: 0.3s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,198,255,0.4);
    }

    h2 {
      font-size: 22px;
      margin-bottom: 12px;
      color: #00c6ff;
      border-left: 4px solid #00c6ff;
      padding-left: 10px;
    }

    .notes-box {
      background: rgba(255,255,255,0.08);
      padding: 15px;
      border-radius: 14px;
      max-height: 280px;
      overflow-y: auto;
      color: #eee;
      font-size: 15px;
      line-height: 1.6;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #aaa;
    }

    .footer span {
      color: #00c6ff;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="app">
    <h1>DevOps Batch 20 Notes</h1>
    <form action="save.php" method="post">
      <textarea name="note" placeholder="✍️ Write something cool..."></textarea>
      <button type="submit">🚀 Save Note</button>
    </form>

    <h2>Your Notes</h2>
    <div class="notes-box">
      <pre>
<?php
if (file_exists("/data/notes.txt")) {
    echo file_get_contents("/data/notes.txt");
} else {
    echo "No notes yet. Start with your first one 🚀";
}
?>
      </pre>
    </div>

    <div class="footer">
      Made with ⚡ by <span>DevOps Batch 17</span>
    </div>
  </div>
</body>
</html>

