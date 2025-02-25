<?php
$servername = "db";
$username = "user";
$password = "password";
$dbname = "test";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
} else {
    echo "Успешное подключение.<br>";
}

// Установка кириллической кодировки
$conn->set_charset("utf8");
echo "Кириллическая кодировка установлена.<br><br>";

// Функция для вывода данных таблицы
function displayTable($conn) {
    echo "<br>--- Текущие данные таблицы customers2 ---<br>";
    $sql = "SELECT * FROM customers2";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "cnum: {$row['cnum']}, cname: {$row['cname']}, city: {$row['city']}, rating: {$row['rating']}, snum: {$row['snum']}, text: {$row['text']}<br>";
        }
    } else {
        echo "Таблица пуста.<br>";
    }
    echo "------------------------------------------<br>";
}

// 5. Добавление записи с однофамильцем
$sql = "INSERT INTO customers2 (cnum, cname, city, rating, snum, text) VALUES (11, 'Котов Антон', 'СанктПетербург', 120, 111, 'однофамилец')";
if ($conn->query($sql) === TRUE) {
    echo "Запись добавлена: Котов Антон, СанктПетербург.<br>";
} else {
    echo "Ошибка добавления: " . $conn->error . "<br>";
}
displayTable($conn);

// 6. Добавление записи John Doee, LA
$sql = "INSERT INTO customers2 (cnum, cname, city, rating, snum, text) VALUES (12, 'John Doee', 'LA', 100, 112, 'New customer')";
if ($conn->query($sql) === TRUE) {
    echo "Запись добавлена: John Doee, LA.<br>";
} else {
    echo "Ошибка добавления: " . $conn->error . "<br>";
}
displayTable($conn);

// 7. Изменение данных John Doee, LA -> John Doe, New York
$sql = "UPDATE customers2 SET cname = 'John Doe', city = 'New York' WHERE cname = 'John Doee' AND city = 'LA'";
if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
    echo "Данные обновлены: John Doe, New York.<br>";
} else {
    echo "Ошибка обновления или данные не найдены.<br>";
}
displayTable($conn);

// 8. Удаление записи по фамилии
$sql = "DELETE FROM customers2 WHERE cname = 'Котов Антон'";
if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
    echo "Запись с фамилией Котов Антон удалена.<br>";
} else {
    echo "Ошибка удаления или запись не найдена.<br>";
}
displayTable($conn);

// 9. Удаление всех записей с номером больше 2010
$sql = "DELETE FROM customers2 WHERE cnum >= 9";
if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
    echo "Все записи с номером >= 9 удалены.<br>";
} else {
    echo "Ошибка удаления или такие записи отсутствуют.<br>";
}
displayTable($conn);

// Закрываем соединение
$conn->close();
?>
