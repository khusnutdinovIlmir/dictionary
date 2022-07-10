<?php

function normalize_csv_files_array($files)
{
  $normalized_files_arr = [];

  foreach ($files as $att_name => $value) {
    foreach ($value as $index => $item) {
      $normalized_files_arr[$index][$att_name] = $item;
    }
  }

  return $normalized_files_arr;
}

function correct_ext($ext)
{
  $allow_to_upload = ['csv'];

  if (in_array(strtolower($ext), $allow_to_upload)) return true;
  else return false;
}

function upload_files($files)
{
  $path = '/uploads/';

  $response = array();

  foreach ($files as $file) {

    $file_name = $file['name'];
    $temp_file_name = $file['tmp_name'];
    $ext = (pathinfo($file_name, PATHINFO_EXTENSION));

    if (!correct_ext($ext)) {
      $response[] = array(
        "filename" => $file_name,
        "status" => 0,
        "error" => "не верное расширение файла"
      );
    } else {
      if (!file_exists(getcwd() . $path)) {
        mkdir(getcwd() . $path, 0777);
      }
      $file_name_to_upload = uniqid() . '.' . $ext;

      if (move_uploaded_file($temp_file_name, getcwd() . $path . $file_name_to_upload)) {
        $response[] = array(
          "filename" => $file_name,
          "status" => 1,
          "error" => ""
        );
      } else {
        $response[] = array(
          "filename" => $file_name,
          "status" => 0,
          "error" => "ошибка загрузки файла"
        );
      }
    }
  }
  return $response;
}

function createResponseHtml($response) {
  $html = '';

  foreach ($response as $res) {
    if ($res['status'] == 1) {
      $html = $html . '<li class="upload-results__item success">';
      $html = $html . '<span class="file-name">' . $res['filename'] . '</span>';
      $html = $html . '<span class="status">загружен</span>';
      $html = $html . '</li>';
    }
    else {
      $html = $html . '<li class="upload-results__item error">';
      $html = $html . '<span class="file-name">' . $res['filename'] . '</span>';
      $html = $html . '<span class="status">не загружен (' . $res['error'] . ')</span>';
      $html = $html . '</li>';
    }
  }

  return $html;
}

$files = $_FILES['file'];

if (!isset($_FILES['file'])) {
  $error = 'Файлы не загружены';
} else {
  $normalized_files_arr = normalize_csv_files_array($files);
  $response = upload_files($normalized_files_arr);
  echo createResponseHtml($response);
  exit();
}
