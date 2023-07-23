<?php
header("Access-control-allow-origin: *");
header("content-type: application/json; charset=UTF-8");

include_once "./../../databaseconnect.php";
include_once "./../../model/room2.php";

$databaseConnect = new DatabaseConnect();
$connDB = $databaseConnect->getConnection();

$room2 = new Room2($connDB);

//เรียกใช้ Function ตามวัตถุประสงค์ของ API ตัวนี้
$stmt = $room2->getAllTempRoom2();

//นับแถวเพื่อดูว่าได้ข้อมูลมาไหม 
$numrow = $stmt->rowCount();

//สร้างตัวแปรมาเก็บข้อมูลที่ได้จากการเรียกใช้ function เพื่อส่งกับไปยังส่วนที่เรียกใช้ API
$room2_arr = array();

//ตรวจสอบผล และส่งกลับไปยังส่วนที่เรียกใช้ API
if ($numrow > 0) {
    //มีข้อมูล เอาข้อมูลใสาตัวแปร และเตรียมส่งกลับ
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $room2_item = array(
            "message" => "1",
            "id" => $id,
            "airValue1" => $airValue1,
            "airValue2" => $airValue2,
            "airValue3" => $airValue3,
            "roomDate" => $roomDate,
            "roomTime" => $roomTime
        );

        array_push($room2_arr, $room2_item);
    }
} else {
    //ไม่มีข้อมูล เอาข้อมูลใสาตัวแปร และเตรียมส่งกลับ
    $room2_item = array(
        "massage" => "0"
    );
        array_push($room2_arr, $room2_item);
}

//คำสั่งจัดการข้อมูลใหเฃ้เป็น JSON เพื่อส่งกลับ
http_response_code(200);
echo json_encode($room2_arr);
