<?php 
    if (!empty($_COOKIE['sid'])) {session_id($_COOKIE['sid']);}
    session_start();
    require_once 'classes/Auth.class.php';
    require_once 'stayt.php';
?><!DOCTYPE html>
<html>
<head>
<title>1ndryxa</title>
<meta charset="utf-8"/>
<link href="media-queries.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?php
if($_FILES)
{
    foreach ($_FILES["uploads"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["uploads"]["tmp_name"][$key];
            $name = "uploads/" . $_FILES["uploads"]["name"][$key];
            move_uploaded_file($tmp_name, "$name");
        }
    }
}
?>
    <!-- Для авторизованных -->
     <?php if (Auth\User::isAuthorized()): ?>
    <div align="center">
    <form style="width: 50%; height: 80%; filter: blur(0px);" method="post" enctype="multipart/form-data">
    <div align="center">
    <form style="width: 50%; height: 80%; filter: blur(0px);" method="post" enctype="multipart/form-data">
    <input type="file" name="uploads[]"/>
    <input class="input" type="submit" value="Загрузить"/>
    <?php
  $dir = 'uploads/'; // Папка с изображениями
  $cols = 3; // Количество столбцов в будущей таблице с картинками
  $files = scandir($dir); // Берём всё содержимое директории
  echo "<table>"; // Начинаем таблицу
  $k = 0; // Вспомогательный счётчик для перехода на новые строки
  for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
    if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
      if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
      echo "<td>"; // Начинаем столбец
      $path = $dir.$files[$i]; // Получаем путь к картинке
      echo "<a href='$path'>"; // Делаем ссылку на картинку
      echo "<img src='$path' alt='' width='150' />"; // Вывод превью картинки
      echo "</a>"; // Закрываем ссылку
      echo "</td>"; // Закрываем столбец
      /* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
      if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
      $k++; // Увеличиваем вспомогательный счётчик
    }
  }
  echo "</table>"; // Закрываем таблицу
?>
</form>
</div>
<button class="goGS" style="position: absolute; left: 42%; top: 80%;" onclick="window.location.href='http://127.0.0.1/raochaya/1ndryxa.html'">Вернуться на Главную Страницу</button>

     <!-- Для НЕ авторизованных -->
     <?php else: ?>
     <h1 align="center" style="color: white;">Войдите в аккаунт</h1>
     <button class="goGS" style="position: absolute; left: 42%; top: 80%;" onclick="window.location.href='http://127.0.0.1/raochaya/1ndryxa.html'">Вернуться на Главную Страницу</button>

     <!-- Конец условия -->
     <?php endif; ?>
</body>
</html>