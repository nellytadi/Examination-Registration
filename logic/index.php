<?php

require_once '../src/DatabaseQueries.php';
require_once '../src/StorePassport.php';
require_once '../src/SendEmail.php';


header('Content-Type: application/json; charset=UTF-8');

if (isset($_POST['submit'])) {

    if (isset($_FILES["passport"]["name"])) {
        $store = new StorePassport();
        $filename = $store->store();
    }
    else {
        http_response_code(404);
        die(json_encode(array('message' => "Please select a file to upload.")));
    }


    try {

        $queries = new DatabaseQueries();

        $student=array();

        $student['surname'] = $_POST['surname'];
        $student['other_name'] = $_POST['other_name'];
        $student['contact_number'] = $_POST['contact_number'];
        $student['email'] = $_POST['email'];
        $student['date_of_birth'] = $_POST['date_of_birth'];
        $student['gender'] = $_POST['gender'];
        $student['school'] = $_POST['school'];
        $student['class'] = $_POST['class'];
        $student['residing_state'] = $_POST['residing_state'];
        $student['amount'] = $_POST['amount'];
        $student['passport'] = $filename;
        $student['created_at'] = date('Y-m-d H:i:s');

        $student['newExamNumber'] = $queries->getExamNumber();

        $queries->storeDetails($student);

        $mail = new SendEmail($student);


    } catch (PDOException  $e) {
        http_response_code(409);
        die(json_encode(array('message' => "Error storing data: {$e->getMessage()}")));
    }

} else {

    http_response_code(404);
    die(json_encode(array('message' => 'Form is empty')));
}
