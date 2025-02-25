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

// Задание 1: Таблица чисел mxn с выделением простых чисел цветом
function isPrime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

$m = 5; $n = 5; // Размер таблицы
echo "<table border='1'>";
for ($i = 1; $i <= $m; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $n; $j++) {
        $num = ($i - 1) * $n + $j; // Последовательные числа
        $color = isPrime($num) ? "green" : "white";
        echo "<td style='background-color: $color;'>$num</td>";
    }
    echo "</tr>";
}
echo "</table><br>";

// Задание 2: Массивы дней недели и месяцев, вывод текущей даты
$days = ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"];
$months = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
$date = getdate();
$day = $days[$date['wday']];
$month = $months[$date['mon'] - 1];
echo "Сегодня $day, {$date['mday']} $month<br><br>";

// Задание 3: Функция для вывода текущей даты и даты через N дней
function showDates($days) {
    $current = date('l jS \of F Y', strtotime('now'));
    $future = date('l jS \of F Y', strtotime("+$days days"));
    echo "Текущая дата: $current<br>";
    echo "Дата через $days дней: $future<br>";
}
showDates(40);
echo "<br>";

// Задание 4: Функция калькулятора с тремя аргументами
function calculate($num1, $num2, $operator) {
    switch ($operator) {
        case '+': return $num1 + $num2;
        case '-': return $num1 - $num2;
        case '*': return $num1 * $num2;
        case '/': return $num2 != 0 ? $num1 / $num2 : "Ошибка: деление на 0";
        default: return "Неизвестный оператор";
    }
}
echo "5 + 3 = " . calculate(5, 3, '+') . "<br>";
echo "10 - 4 = " . calculate(10, 4, '-') . "<br>";
echo "6 * 2 = " . calculate(6, 2, '*') . "<br>";
echo "8 / 2 = " . calculate(8, 2, '/') . "<br><br>";

// Задание 5: Функция умножения без оператора умножения
function multiplyWithoutOperator($num1, $num2) {
    $result = 0;
    $absNum2 = abs($num2);
    for ($i = 0; $i < $absNum2; $i++) {
        $result += $num1;
    }
    return $num2 < 0 ? -$result : $result;
}
$num1 = 6; $num2 = -3;
echo "$num1 × $num2 = " . multiplyWithoutOperator($num1, $num2) . "<br><br>";

// Задание 6 и 7: Функция для чтения файла с фамилиями и фильтрации по символу
function readNames($filter = 1) {
    $f = fopen('names.txt', 'r');
    echo "Результат для фильтра '$filter':<br>";
    while (!feof($f)) {
        $line = trim(fgets($f));
        if ($line) {
            // Преобразуем первую букву в верхний регистр с учетом кодировки
            $line = mb_convert_case($line, MB_CASE_TITLE, "UTF-8");
            if ($filter === 1) {
                echo "$line<br>";
            } elseif (is_string($filter) && mb_substr($line, 0, 1, 'utf-8') === $filter) {
                echo "$line<br>";
            }
        }
    }
    fclose($f);
    echo "<br>";
}
// Предполагается, что файл names.txt содержит, например:
// петров иван иванович 22
// сидоров пётр петрович 25
// павлов николай александрович 30
readNames(1); // Все фамилии
readNames('П'); // Только на 'П'

// Задание 8: Чтение файла в ассоциативный массив с ФИО и возрастом
function loadPersons() {
    global $person;
    $f = fopen('names.txt', 'r');
    $person = array();
    while (!feof($f)) {
        $line = trim(fgets($f));
        if ($line) {
            $data = explode(" ", $line);
            $lastname = mb_convert_case($data[0], MB_CASE_TITLE, "UTF-8");
            $person[$lastname] = [
                'name' => mb_convert_case($data[1], MB_CASE_TITLE, "UTF-8"),
                'patronymic' => mb_convert_case($data[2], MB_CASE_TITLE, "UTF-8"),
                'age' => $data[3]
            ];
        }
    }
    fclose($f);
}
$person = array();
loadPersons();
echo "<pre>";
print_r($person);
echo "</pre>";
echo $person['Петров']['name'] . " " . $person['Петров']['age'] . "<br>";


// Закрываем соединение
$conn->close();
?>
