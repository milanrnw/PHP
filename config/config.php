<?php
class config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "php_03";

    private $conn;

    public function connectDB()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connectDB();
        $query = "INSERT INTO students(name, age, course) VALUES ('$name',$age,'$course')";
        return mysqli_query($this->conn, $query); //boolean insert(true/false)
    }

    public function fetchAllStudents()
    {
        $this->connectDB();
        $query = "SELECT * FROM students";
        return mysqli_query($this->conn, $query); //object of mysqli_result class
    }

    public function deleteStud($id)
    {
        $this->connectDB();
        $result = $this->fetchSingleStudent($id);
        $single_student = mysqli_fetch_array($result);
        if ($single_student) {
            $query = "DELETE FROM students WHERE id=$id";
            return mysqli_query($this->conn, $query); //boolean delete(true/false)
        } else {
            return false;
        }

    }

    public function fetchSingleStudent($id)
    {
        $this->connectDB();
        $query = "SELECT * FROM students WHERE id=$id";
        return mysqli_query($this->conn, $query); //object of mysqli_result class
    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connectDB();

        $result = $this->fetchSingleStudent($id);

        $single_student = mysqli_fetch_assoc($result);

        if ($single_student) {
            $query = "UPDATE students SET name='$name', age=$age, course='$course' WHERE id=$id";
            return mysqli_query($this->conn, $query);
        } else {
            return false;
        }
    }

    public function loginUser($email, $password)
    {
        $this->connectDB();
        $query = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($this->conn, $query);

        $user = mysqli_fetch_assoc($res);

        if ($user) {
            return password_verify($password, $user['password']);
        } else {
            return false;
        }
    }

}
?>