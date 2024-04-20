//Функция удаления задач
function deleteTask(taskId) {
    if (confirm("Удалить задачу?")) {
        fetch(`delete_task.php?id=${taskId}`, {
            method: 'GET'
        })
            .then(() => {
                window.location.reload(); // Перезагрузка страницы  
            })
            .catch((error) => {
                console.log('Ошибка удаления задачи');
            })
    }
}

// Фунцкия загрузки задач с сервером и отображение на странице 
function loadTasks() {
    fetch('get_tasks.php') //отправка get запроса на сервер для получения задач
        .then((response) => {
            // декодирует ответ в формате JSON 
            return response.json()
        })
        .then((data) => {
            // В параметр датапостумает результат декодирование ответа в ормате JSON
            // то есть мы получаем данные файлом get_tasks из БД
            // На текущей моментв параметре data содержится из JSON массив задач из БД
            console.log(data)
            //Получение элемента списка задач
            const taskList = document.querySelector('#task-list');
            //Очистка списка задач перед обновления
            taskList.innerHeight = '';
            // перебираем полученный массив задач
            data.forEach((task) => {
                // Создать новый элемент списка
                const listItem = document.createElement('li')
                listItem.classList.add('task-item')
                listItem.innerHTML =
                    `<div class="task-info">
                        Дата: ${task.task_date}
                        <br>Время: ${task.task_time}
                        <br>Задача: ${task.tas}
                        <br>Важность: ${task.priority}
                    </div>
                    <button class="task-del" onclick='deleteTask(${task.id})'>Удалить</button>
                    `

                taskList.appendChild(listItem);
            })

        })
        .catch((error) => {
            console.log("Ошибка при загрузке задач!")
        })
}

loadTasks();