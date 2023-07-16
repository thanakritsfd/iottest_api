<?php
class Room3{
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

}