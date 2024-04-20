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
} else {
    echo "Успешное подключение к БД";
}

if (
    isset($_POST['task']) && !empty($_POST['task']) &&
    isset($_POST['task_date']) && !empty($_POST['task_date']) &&
    isset($_POST['task_time']) && !empty($_POST['task_time']) &&
    isset($_POST['priority']) && !empty($_POST['priority'])
) {
    // Защитв данных от SQL-иньекций
    // $task = mysqli_real_escape_string() - экранирует специальные символы в строке для использование SQL выражении 
    $task = mysqli_real_escape_string($connection, $_POST['task']);
    $task_date = mysqli_real_escape_string($connection, $_POST['task_date']);
    $task_time = mysqli_real_escape_string($connection, $_POST['task_time']);
    $priority = mysqli_real_escape_string($connection, $_POST['priority']);

    // Создаем SQL запрос для вставки новой задачи в БД
    $query = "INSERT INTO tasks (task, task_date, task_time, priority) VALUE ('$task', '$task_date', '$task_time', '$priority')";
    // Выполняем наш запроc
    $result = mysqli_query($connection, $query);
    if ($result) {
        //Если запрос выполнился успешно
        header("Location: index.php"); // Перенаправляем пользователя на главную страницу
    } else {
        // Если выполнился не успешно
        echo 'Ошибка при добавлении задачи'; // Выводим сообщение об ошибке
    }
}
mysqli_close($connection);
