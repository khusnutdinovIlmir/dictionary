<?php

function createWordTranslateTraining()
{
  $conn = require_once 'connectDB.php';
  $sqlSelect = "SELECT * FROM dictionary ORDER BY rand() LIMIT 20";
  $result = $conn->query($sqlSelect);
  echo '<form method="post" action="../core/check-training-result.php" id="training-form" class="training-area">';
  echo '<h2 class="training-header">Слово-перевод</h2>';
  echo '<ul class="training-tasks">';
  $i = 0;
  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    echo '<li id="' . $row->id . '" class="training-tasks__item">';
    echo '<label for="word-' . $row->id . '">' . $row->word . '</label>';
    echo '<input id="word-' . $row->id . '" name="' . $row->id . '" type="text" />';
    echo '</li>';
  }
  echo '</ul>';
  echo '<div class="training-result">';
  echo '<span class="correct"></span>';
  echo '<span class="wrong"></span>';
  echo '</div>';
  echo '<button id="check-training" class="submit" type="button">Проверить тест</button>';
  echo '<input name="training-name" type="hidden" value="word-translate" />';
  echo '</form>';
}

function createTranslateWordTraining()
{
  $conn = require_once 'connectDB.php';
  $sqlSelect = "SELECT * FROM dictionary ORDER BY rand() LIMIT 20";
  $result = $conn->query($sqlSelect);
  echo '<form method="post" action="../core/check-training-result.php" id="training-form" class="training-area">';
  echo '<h2 class="training-header">Слово-перевод</h2>';
  echo '<ul class="training-tasks">';
  $i = 0;
  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    echo '<li id="' . $row->id . '" class="training-tasks__item">';
    echo '<label for="word-' . $row->id . '">' . $row->translate . '</label>';
    echo '<input id="word-' . $row->id . '" name="' . $row->id . '" type="text" />';
    echo '</li>';
  }
  echo '</ul>';
  echo '<div class="training-result">';
  echo '<span class="correct"></span>';
  echo '<span class="wrong"></span>';
  echo '</div>';
  echo '<button id="check-training" class="submit" type="button">Проверить тест</button>';
  echo '<input name="training-name" type="hidden" value="translate-word" />';
  echo '</form>';
}

function createOptions($conn, $row)
{
  $sqlSelectOption = "SELECT * FROM dictionary ORDER BY rand() LIMIT 4";
  $resultOptions = $conn->query($sqlSelectOption);
  $res = $resultOptions->fetchAll(PDO::FETCH_OBJ);
  $rand_id = rand(0, 3);
  $res[$rand_id] = $row;
  return $res;
}

function createWordTranslateTest()
{
  $conn = require_once 'connectDB.php';
  $sqlSelect = "SELECT * FROM dictionary ORDER BY rand() LIMIT 20";
  $result = $conn->query($sqlSelect);
  echo '<form method="post" action="../core/check-training-result.php" id="training-form" class="training-area">';
  echo '<h2 class="training-header">Слово-перевод</h2>';
  echo '<ul class="training-tasks">';
  $question_num = 0;
  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    echo '<li id="' . $row->id . '" class="training-tasks__item-test">';
    echo '<div class="question">Как переводится слово "<b>' . $row->word . '</b>"?</div>';
    echo '<input id="question" type="hidden" name="question[]" value="' . $row->id . '" />';
    echo '<div class="answer-options">';
    $options = createOptions($conn, $row);
    $option_num = 0;
    foreach ($options as $option) {
      echo '<div class="option">';
      $label_id = 'q' . $question_num . '_o' . $option_num++;
      echo '<label for="' . $label_id . '">' . $option->translate . '</label>';
      echo '<input id="' . $label_id . '" type="radio" name="answer[' . $question_num . ']" value="' . $option->translate . '" />';
      echo '</div>';
    }
    echo '</div>';
    echo '</li>';
    $question_num++;
  }
  echo '</ul>';
  echo '<div class="training-result">';
  echo '<span class="correct"></span>';
  echo '<span class="wrong"></span>';
  echo '</div>';
  echo '<button id="check-training-test" class="submit" type="button">Проверить тест</button>';
  echo '<input name="training-name" type="hidden" value="test_word-translate" />';
  echo '</form>';
}

function createTranslateWordTest()
{
  $conn = require_once 'connectDB.php';
  $sqlSelect = "SELECT * FROM dictionary ORDER BY rand() LIMIT 20";
  $result = $conn->query($sqlSelect);
  echo '<form method="post" action="../core/check-training-result.php" id="training-form" class="training-area">';
  echo '<h2 class="training-header">Слово-перевод</h2>';
  echo '<ul class="training-tasks">';
  $question_num = 0;
  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    echo '<li id="' . $row->id . '" class="training-tasks__item-test">';
    echo '<div class="question">Как переводится слово "<b>' . $row->translate . '</b>"?</div>';
    echo '<input id="question" type="hidden" name="question[]" value="' . $row->id . '" />';
    echo '<div class="answer-options">';
    $options = createOptions($conn, $row);
    $option_num = 0;
    foreach ($options as $option) {
      echo '<div class="option">';

      $label_id = 'q' . $question_num . '_o' . $option_num++;

      echo '<label for="' . $label_id . '">' . $option->word . '</label>';
      echo '<input id="' . $label_id . '" type="radio" name="answer[' . $question_num . ']" value="' . $option->word . '" />';
      echo '</div>';
    }
    echo '</div>';
    echo '</li>';
    $question_num++;
  }
  echo '</ul>';
  echo '<div class="training-result">';
  echo '<span class="correct"></span>';
  echo '<span class="wrong"></span>';
  echo '</div>';
  echo '<button id="check-training-test" class="submit" type="button">Проверить тест</button>';
  echo '<input name="training-name" type="hidden" value="test_translate-word" />';
  echo '</form>';
}

$training_id = $_GET['id'];
if ($training_id === '0') {
  createWordTranslateTraining();
} else if ($training_id === '1') {
  createTranslateWordTraining();
} else if ($training_id === '2') {
  createWordTranslateTest();
} else if ($training_id === '3') {
  createTranslateWordTest();
}
