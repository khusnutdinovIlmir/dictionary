<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/styles.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <title>Словарь</title>
</head>

<body>
  <?php
  require './core/header.php'
  ?>

  <div class="dictionary-list">
    <?php
    $del = './core/delete-word.php';
    $conn = require_once './core/connectDB.php';
    $sql_select = "SELECT * FROM dictionary ORDER BY id DESC";
    $result = $conn->query($sql_select);
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
      echo '<div class="dictionary-list__item">';
      echo '<div class="word">';
      echo '<span class="word">' . $row->word . '</span>';
      echo '<span class="translate">' . $row->translate . '</span>';
      echo '</div>';
      echo '<a href="' . $del . '?id=' . $row->id . '" class="delete">';
      echo '<button id="del-item" type="submit">Удалить</button>';
      echo '</a>';
      echo '</div>';
    }
    ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./script/index.js"></script>
</body>

</html>