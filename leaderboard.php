<?php
include 'db_connect.php';
$result = $conn->query("SELECT username, level_name, time_left, points, date_played 
                        FROM score 
                        ORDER BY points DESC, date_played DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leaderboard - Banana Puzzle Adventure</title>
  <style>
    body {
      background: linear-gradient(135deg, #0b3d2e, #164a36);
      font-family: 'Poppins', sans-serif;
      color: #fff;
      text-align: center;
    }
    h1 {
      color: #ffce00;
      margin-top: 20px;
    }
    table {
      margin: 30px auto;
      border-collapse: collapse;
      width: 75%;
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }
    th, td {
      padding: 15px;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    th {
      color: #ffce00;
    }
    tr:hover {
      background: rgba(255,255,255,0.15);
    }
  </style>
</head>
<body>
  <h1>🍌 Leaderboard</h1>
  <table>
    <tr>
      <th>Player</th>
      <th>Level</th>
      <th>Time Left (s)</th>
      <th>Points</th>
      <th>Date Played</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
        <td><?php echo htmlspecialchars($row['level_name']); ?></td>
        <td><?php echo htmlspecialchars($row['time_left']); ?></td>
        <td><?php echo htmlspecialchars($row['points']); ?></td>
        <td><?php echo htmlspecialchars($row['date_played']); ?></td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>
