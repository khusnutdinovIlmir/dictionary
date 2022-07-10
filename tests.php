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
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    />
    <title>Словарь</title>
  </head>

  <body>
    <?php
    require './core/header.php';
    ?>

    <div class="training-word">
      <div class="training-word__training">
        <a class="training" id="0">
          <div class="training-info">
            <h2 class="training-name">Слово-перевод</h2>
            <img src="/src/word-translate.svg" alt="" />
          </div>
        </a>
      </div>
      <div class="training-word__training">
        <a class="training" id="1">
          <div class="training-info">
            <h2 class="training-name">Перевод-слово</h2>
            <img src="/src/translate-word.svg" alt="" />
          </div>
        </a>
      </div>
      <div class="training-word__training">
        <a class="training" id="2">
          <div class="training-info">
            <h2 class="training-name">
              <span class="name">Тестирование</span>
              <span class="cls">"Слово-перевод"</span>
            </h2>
            <img src="/src/word-test.svg" alt="" />
          </div>
        </a>
      </div>
      <div class="training-word__training">
        <a class="training" id="3">
          <div class="training-info">
            <h2 class="training-name">
              <span class="name">Тестирование</span>
              <span class="cls">"Перевод-слово"</span>
            </h2>
            <img src="/src/word-test.svg" alt="" />
          </div>
        </a>
      </div>
    </div>

    <div class="training-popup"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/index.js"></script>
  </body>
</html>
