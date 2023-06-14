<?php

function executeQuery($sqlQuery, $check)
{
    $connect = new PDO("mysql:host=127.0.0.1;dbname=assignment-php1;charset=utf8", "root", "");

    //3.1 Nạp câu spl vào kết nối
    $stmt = $connect->prepare($sqlQuery);

    //3.2 Thực thi câu lệnh với db
    $stmt->execute();
    $data = [];
    //4. Nhận dữ liệu trả về từ câu sql
    return $check ? $data = $stmt->fetchAll() : $data = $stmt->fetch();
}
