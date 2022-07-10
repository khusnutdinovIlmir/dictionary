<?php
$conn = require_once 'connectDB.php';

$answer = [
  'correct' => [],
  'wrong' => []
];
$training = $_POST['training-name'];
$training2 = $_GET['training-name'];

if ($training === 'word-translate') {
  foreach ($_POST as $id => $translate) {
    if ($id === 'training-name') continue;
    $sql = "SELECT * FROM dictionary WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $row = $query->fetch(PDO::FETCH_OBJ);
    if ($translate !== $row->translate) $answer['wrong'][] = $id;
    else $answer['correct'][] = $id;
  }
}
else if ($training === 'translate-word') {
  foreach ($_POST as $id => $word) {
    $sql = "SELECT * FROM dictionary WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $row = $query->fetch(PDO::FETCH_OBJ);
    if ($word !== $row->word) $answer['wrong'][] = $id;
    else $answer['correct'][] = $id;
  }
}
if ($training === 'test_word-translate') {
  $question_arr = $_POST['question'];
  $answer_arr = $_POST['answer'];
  $questionsLen = count($question_arr);

  for ($i = 0; $i < $questionsLen; $i++) {
    $id = $question_arr[$i];
    $sql = "SELECT * FROM dictionary WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $row = $query->fetch(PDO::FETCH_OBJ);

    if ($answer_arr[$i] !== $row->translate) $answer['wrong'][] = $id;
    else $answer['correct'][] = $id;
  }
}
else if ($training === 'test_translate-word') {
  $question_arr = $_POST['question'];
  $answer_arr = $_POST['answer'];
  $questionsLen = count($question_arr);

  for ($i = 0; $i < $questionsLen; $i++) {
    $id = $question_arr[$i];
    $sql = "SELECT * FROM dictionary WHERE id=?";
    $query = $conn->prepare($sql);
    $query->execute([$id]);
    $row = $query->fetch(PDO::FETCH_OBJ);

    if ($answer_arr[$i] !== $row->word) $answer['wrong'][] = $id;
    else $answer['correct'][] = $id;
  }
}

exit(json_encode($answer));

?>