<?php
class Room1
{
    //ตัวแปรที่ใช้ในการติดต่อ Database
    private $conn;

    //ตัวแปรที่จะทำงานคู่กับแต่ละฟิวล์ในตาราง
    public $id;
    public $airValue1;
    public $airValue2;
    public $airValue3;
    public $roomDate;
    public $roomTime;

    //ตัวแปรที่เก็บข้อความต่าง ๆ เผื่อไว้ใช้งาน เฉย ๆ
    public $message;

    //คอนตรักเตอร์ที่จะมีคำสั่งที่ใช้ในการติดต่อกับ Database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //ฟังก์ชั่นต่าง ๆ ที่จะทำงานกับ Database ตาม API ที่เราจะทำการสร้างมันขึ้นมา ซึ่งมีมากน้อยแล้วแต่
    //function getAllTempRoom1 ที่ทำงานกับ api_getAllTempRoom1.php
    //วัตถุประสงค์ของ function นี้คือการไปเอาอุณหภูมิที่มีทั้งหมดในตาราง room1 มา
    function getAllTempRoom1()
    {
        $strSQL = "SELECT * FROM room1_tb";

        $stmt = $this->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;
    }

    //function getAirValue2Room1
    //ต้องการอุณหภูมิแค่ Air ตัวที่ 2
    function getAirValue2Room1()
    {
        $strSQL = "SELECT airValue2, roomDate, roomTime FROM room1_tb";

        $stmt = $this->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;
    }

    //function getAllTempLessThen20Room1
    //ต้องการแอร์ทุกตัวที่น้อยกว่า 20 องศา
    function getAllTempLessThen20Room1()
    {
        $strSQL = "SELECT * FROM room1_tb WHERE airValue1 < 20 and airValue2 < 20 and airValue3 < 20";

        $stmt = $this->conn->prepare($strSQL);

        $stmt->execute();

        return $stmt;
    }
}
