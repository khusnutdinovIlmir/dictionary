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

  <div class="add-new-words">
    <form id="upload-word" class="add-new-words__with-form" method="POST" action="./core/upload_to_db.php">
      <div class="new-word">
        <div class="word">
          <label>Слово</label>
          <input name="word" type="text"/>
        </div>
        <div class="word">
          <label>Перевод</label>
          <input name="translate" type="text" />
        </div>
      </div>
      <button id="upload-one-word" class="submit" type="button">Добавить слово в словарь</button>
      <input type="hidden" name="hidden" value="one-word" />
    </form>
    <hr />
    <div class="add-new-words__with-file">
      <div class="drop-file-field" ondrop="upload_file(event)" ondragover="return false">
        <div class="drag-and-drop-field">
          <p>Перетащите файл(ы) в формате csv</p>
          <p>или</p>

          <input class="submit" type="button" value="Выберите файл(ы) в формате csv" onclick="file_explorer();" />

          <input type="file" id="selectfile" multiple />
        </div>
        <div class="upload-results">
        </div>
      </div>
      <form id="upload-words" method="POST" action="./core/upload_to_db.php">
        <button class="submit" type="submit">
          Загрузить слова из csv в словарь
        </button>
        <input type="hidden" name="hidden" value="csv-file" />
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./script/index.js"></script>
</body>

</html>