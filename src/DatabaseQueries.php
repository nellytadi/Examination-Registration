<?php
require_once '../src/DatabaseConnection.php';
/**
 * Created by PhpStorm.
 * User: nelly
 * Date: 3/9/2021
 * Time: 1:59 PM
 */
class DatabaseQueries
{
    public $conn;

    public function __construct()
    {
        $this->conn = new DatabaseConnection();
    }

    public function getExamNumber(){

        $conn = $this->conn->connect();

        $stmt = $conn->prepare("SELECT * FROM maths_competition ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            $newExamNumber = $result["examination_number"] + 1;
        } else {
            $newExamNumber = 10000;
        }
        return $newExamNumber;
    }

    public function storeDetails($student){
        //store form details
        $surname = $student['surname'];
        $newExamNumber = $student['newExamNumber'];
        $other_name = $student['other_name'];
        $contact_number = $student['contact_number'];
        $email = $student['email'];
        $date_of_birth = $student['date_of_birth'];
        $gender = $student['gender'];
        $school = $student['school'];
        $class = $student['class'];
        $residing_state = $student['residing_state'];
        $amount = $student['amount'];
        $passport = $student['passport'];

        $conn = $this->conn->connect();


        $stmt2 = $conn->prepare("INSERT INTO maths_competition (id, examination_number, surname, other_name, contact_number, email, date_of_birth, gender, school, class, residing_state, amount, passport, created_at) VALUES (NULL, :newExamNumber, :surname, :other_name, :contact_number, :email, :date_of_birth, :gender, :school,  :class, :residing_state, :amount, :passport, NOW())");


        $stmt2->bindParam(':newExamNumber', $newExamNumber);
        $stmt2->bindParam(':surname', $surname);
        $stmt2->bindParam(':other_name', $other_name);
        $stmt2->bindParam(':contact_number', $contact_number);
        $stmt2->bindParam(':email', $email);
        $stmt2->bindParam(':date_of_birth', $date_of_birth);
        $stmt2->bindParam(':gender', $gender);
        $stmt2->bindParam(':school', $school);
        $stmt2->bindParam(':residing_state', $residing_state);
        $stmt2->bindParam(':class', $class);
        $stmt2->bindParam(':amount', $amount);
        $stmt2->bindParam(':passport', $passport);

        if ($stmt2->execute())
            return true;
        return false;

    }
}