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

// ОRDER BY - сортировать записи по определенному полю при выборе из БД
// ASC - это устанавливает порядок сортировки по возрастанию от < до >
$query = "SELECT * FROM tasks ORDER BY task_date ASC, task_time ASC";

$result = mysqli_query($connection, $query); // Выполнить запрос на получение результата

$tasks = []; // пустой массив для хранеие задач

while ($row = mysqli_fetch_assoc($result)) {
    //mysqli_fetch_assoc - она выбирает одну строку данных из набора результатов и возращает её в виде ассоциативный массива
    // каждый последующий вызов этой функции будет возращать следущую строку в наборе результатов или нуулл, если строк больше нет
    $tasks[] = $row;
}

echo json_encode($tasks); // Преобразует массив задач в JSON и выводит на экран
mysqli_close($connection); // Закрыть соединеие с БД