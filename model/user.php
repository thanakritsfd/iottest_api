<?php
class User{
    //ตัวแปรที่ใช้ในการติดต่อ Database
    private $conn;

    //ตัวแปรที่จะทำงานคู่กับแต่ละฟิวล์ในตาราง
    public $userId;
    public $userFullname;
    public $userName;
    public $userPassword;
    public $userStatus;

    //ตัวแปรที่เก็บข้อความต่าง ๆ เผื่อไว้ใช้งาน เฉย ๆ
    public $message;

    //คอนตรักเตอร์ที่จะมีคำสั่งที่ใช้ในการติดต่อกับ Database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //ฟังก์ชั่นต่าง ๆ ที่จะทำงานกับ Database ตาม API ที่เราจะทำการสร้างมันขึ้นมา ซึ่งมีมากน้อยแล้วแต่
    //function loginUser ที่ทำงานกับ api_loginuser.php
    function loginUser(){
        //คำสั่ง SQL
        $strSQL = "SELECT * FROM user_tb WHERE userName = :userName and userPassword = :userPassword";

        //กำหนด Statement ที่จะทำงานกับคำสั่ง SQL
        $stmt = $this->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

        //กำหนดข้อมูลให้ Parameter
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":userPassword", $this->userPassword);

        //สั่งให้ SQL ทำงาน
        $stmt->execute();

        //ส่งผลลัพธ์ที่ได้จากคำสั่ง SQL ไปใช้งาน
        return $stmt;

    }

    //function registerUser ที่ทำงานกับ api_registerUser.php
    function registerUser(){
        $strSQL = "INSERT INTO user_tb (userFullname, userName, userPassword, userStatus) VALUES(:userFullname, :userName, :userPassword, :userStatus)";

        $stmt = $this->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userFullname = htmlspecialchars(strip_tags($this->userFullname));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
        $this->userStatus = 1;

        //กำหนดข้อมูลให้ Parameter
        $stmt->bindParam(":userFullname", $this->userFullname);
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":userPassword", $this->userPassword);
        $stmt->bindParam(":userStatus", $this->userStatus);

        //สั่งให้ SQL ทำงาน
        if($stmt->execute()){
            //สำเร็จ
            return true;
        }else{
            //ไม่สำเร็จ
            return false;
        }          
    }

    //function updateUser ที่ทำงานกับ api_updateUser.php
    //":user" parameter user ":" = parameter
    function updateUser(){
        $strSQL = "UPDATE user_tb SET userFullname = :userFullname, userName = :userName, userPassword = :userPassword WHERE userId = :userId";

        $stmt = $this->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userId = intval(htmlspecialchars(strip_tags($this->userId)));
        $this->userFullname = htmlspecialchars(strip_tags($this->userFullname));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

        //กำหนดข้อมูลให้ Parameter
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":userFullname", $this->userFullname);
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":userPassword", $this->userPassword);

        //สั่งให้ SQL ทำงาน
        if($stmt->execute()){
            //สำเร็จ
            return true;
        }else{
            //ไม่สำเร็จ
            return false;
        }  
    }
}