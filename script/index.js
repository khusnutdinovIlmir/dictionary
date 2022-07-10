var fileobj;

function upload_file(e) {
  e.preventDefault();
  ajax_file_upload(e.dataTransfer.files);
}

function file_explorer() {
  document.getElementById('selectfile').click();
  document.getElementById('selectfile').onchange = function () {
    files = document.getElementById('selectfile').files;
    ajax_file_upload(files);
  };
}

function ajax_file_upload(file_obj) {
  if (file_obj != undefined) {
    var form_data = new FormData();
    for (i = 0; i < file_obj.length; i++) {
      form_data.append('file[]', file_obj[i]);
    }

    $.ajax({
      type: 'POST',
      url: '../core/upload_csv.php',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      dataType: "html",
      success: function (data) {
        $(".upload-results").html(data);
      }
    });
  }
}

$("button#upload-one-word").click(e => {
  e.preventDefault();
  let input_word = $("input[name='word']")[0];
  let input_translate = $("input[name='translate']")[0];

  if ((!input_word.value) || (!input_translate.value)) {
    if ((!input_word.value) && (!input_translate.value)) alert("Поля не заполены!");
    else if (!input_word.value) alert("Поле 'Слово' не заполнено");
    else if (!input_translate.value) alert("Поле 'Перевод' не заполнено");
  }
  else {
    let form_action = $("form#upload-word").attr('action');
    let data = $("form#upload-word").serializeArray();
    $.ajax({
      url: form_action,
      type: 'post',
      dataType: 'html',
      data: data,
      complete: function () {
        location.reload();
      },
      success: function (data) {
        alert(data);
      }
    });
  }
});

$("#upload-words").on("submit", function () {
  $.ajax({
    url: '../core/upload_to_db.php',
    method: 'post',
    dataType: 'html',
    data: $(this).serialize(),
    complete: function () {
      location.reload();
    },
    success: function (data) {
      alert(data);
    },
  });
});

$("#del-item").on("submit", function () {
  let href = $(this).attr("href");
  let id = href.split('=').pop();
  $.ajax({
    url: '/core/delete-word.php',
    method: 'get',
    dataType: 'html',
    data: { 'id': id },
    complete: function () {
      location.reload();
    },
    success: function (data) {
      alert(data);
    },
  });
});

$(".training").on("click", function (e) {
  let id = $(this).attr("id");
  $.ajax({
    url: '../core/create-training.php',
    method: 'get',
    dataType: 'html',
    data: { 'id': id },
    success: function (data) {
      $(".training-popup").addClass("training-popup_opened");
      $(".training-popup").html(data);
    },
  });
});


const finishTest = () => {
  let exit = confirm("Вы уверены, что хотите завершить тест?");
  if (exit)
    $(".training-popup").removeClass("training-popup_opened");
};

$(".training-popup").on("click", function (e) {
  if (e.target.className === 'training-popup training-popup_opened') {
    finishTest();
  }
});

$(document).on('click', 'button#check-training', function (e) {
  e.preventDefault();
  var $data = $(this).parent('form').serializeArray();

  $.ajax({
    url: $(this).parent('form').attr('action'),
    type: 'post',
    data: $data,
    dataType: 'json',
    success: function (result) {
      console.log(result);
      correctHtml = $(".correct");
      wrongHtml = $(".wrong");
      $(".training-result").addClass("training-result_show");
      correctAns = 'Правильных ответов - ' + result.correct;
      correctHtml.text('Правильных ответов - ' + result.correct.length);
      wrongHtml.text('Неправильных ответов - ' + result.wrong.length);

      console.log(result.wrong);

      result.correct.forEach(id => {
        correct_id = "#" + id;
        $(correct_id).addClass("training-tasks__item_correct");
      });

      result.wrong.forEach(id => {
        wrong_id = "#" + id;
        $(wrong_id).addClass("training-tasks__item_wrong");
      });

      $('button#check-training').css('display', 'none');

      let newButton = $('<button id="close-training" class="submit" type="button">Завершить тест</button>');
      newButton.appendTo($('#training-form'));

      $('button#close-training').on('click', finishTest);
    }
  });
});

$(document).on('click', 'button#check-training-test', e => {
  e.preventDefault();
  let trainingName = $("input[type='hidden'][name='training-name']")[0].value;
  let data = {
    'training-name': trainingName,
    'question': [],
    'answer': [],
  };
  let questions = $("input[type='hidden'][id='question']");
  let questionLen = questions.length;
  for (let i = 0; i < questionLen; i++) {
    data['question'][i] = questions[i].value;

    data['answer'][i] = 0;
    let input = $("input[type='radio'][name='answer[" + i + "]']");
    for (let j = 0; j < input.length; j++) {
      if (input[j].checked) data['answer'][i] = input[j].value;
      else continue;
    }
  }
  $.ajax({
    url: $('form').attr('action'),
    type: 'post',
    data: data,
    dataType: 'json',
    success: function (result) {
      console.log(result);
      correctHtml = $(".correct");
      wrongHtml = $(".wrong");
      $(".training-result").addClass("training-result_show");
      correctAns = 'Правильных ответов - ' + result.correct;
      correctHtml.text('Правильных ответов - ' + result.correct.length);
      wrongHtml.text('Неправильных ответов - ' + result.wrong.length);

      result.correct.forEach(id => {
        correct_id = "#" + id;
        $(correct_id).addClass("training-tasks__item-test_correct");
      });

      result.wrong.forEach(id => {
        wrong_id = "#" + id;
        $(wrong_id).addClass("training-tasks__item-test_wrong");
      });

      $('button#check-training-test').css('display', 'none');

      let newButton = $('<button id="close-training" class="submit" type="button">Завершить тест</button>');
      newButton.appendTo($('#training-form'));

      $('button#close-training').on('click', finishTest);
    }
  });
})