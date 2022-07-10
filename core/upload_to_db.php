<?php

function read_csv($file)
{
  if (($file = fopen($file, 'r')) !== false) {
    $res = [];
    while (($data = fgetcsv($file, 1000, ',')) !== false) {
      $res[] = $data;
    }
    fclose($file);
  }

  return $res;
}

$conn = require_once './connectDB.php';

if ($_POST['hidden'] === 'one-word') {
  $query = "INSERT INTO dictionary (word, translate) VALUES(:word, :translate)";
  $new_word = $conn->prepare($query);
  $new_word->execute((['word' => $_POST['word'], 'translate' => $_POST['translate']]));
  exit("Слово добавлено в словарь.");
}
else {
  $dir = './uploads';
  $files = scandir($dir);
  foreach ($files as $file) {
    if (($file === '.') or ($file === '..')) continue;

    $filename = $dir . '/' . $file;

    $arr = read_csv($filename);

    foreach ($arr as $el) {
      $word = $el[0];
      $translate = $el[1];

      $query = "INSERT INTO dictionary (word, translate) VALUES(:word, :translate)";
      $new_word = $conn->prepare($query);
      $new_word->execute((['word' => $word, 'translate' => $translate]));
    }

    unlink($filename);
  }
  exit("Слова добавлены в словарь.");
}
