<?php
$host = "localhost"; // хост БД
$username = "root"; // имя пользователя БД
$password = ""; // пароль пользователя БД
$database = "plan"; // Имя БД
// Устанавливаем соединение с БД:
$connection = mysqli_connect($host, $username, $password, $database);

// Если соединение не удалось:
if (!$connection) {
    // Выводим сообщение об ошибке и завершаем выполнение скрипта
    die("Ошибка подключения: " . mysqli_connect_error());
}


if (isset($_GET['id'])) {
    //Если в массиве GET есть данные с ключом id то 
    //Экранируем данные которые хранятся под ключом id
    $id = mysqli_escape_string($connection, $_GET['id']);
    // Создаем запрос по удалению
    $query = "DELETE FROM tasks WHERE id= '$id'";
    // Выполняем запрос
    $result = mysqli_query($connection, $query);
    // Проверям запрос что выполнен успешно
    if ($result) {
        echo 'Задача удаленна!';
    }
}
// Закрываем запрос
mysqli_close($connection);
