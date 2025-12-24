 <?php
 
 // class => is a collection of data members and member functions.
 // class => Blueprints of object.

 // Data members => variables or characteristics.
 // Member functions => Methord or User Defined Functions.

 //Object => instance of class.
 
 echo "<h3> Class 1 Data (unsecure/public)</h3>";
 class students {
    // variables
    public $id;
    public $name;
    public $age;
    public $course;

    // Setter
    public function setStudData($id, $name, $age, $course){
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->course = $course;
    }

    // Getter
    public function getStudData(){
        echo "id : $this->id <br>";
        echo "name : $this->name <br>";
        echo "age : $this->age <br>";
        echo "course : $this->course <br>";
        echo"<br>";
    }
 }

 $s1 = new students;
 $s2 = new students;
 $s3 = new students;
 $s4 = new students;

 $s1->id = 1;
 $s1->name = "ronak";
 $s1->age = 20;
 $s1->course = "python";

 $s1->id = 101;

 $s2->id = 102;
 $s2->name = "rahul";
 $s2->age = 22;
 $s2->course = "AI/ML";

 echo "id : $s1->id <br>";
 echo "name : $s1->name <br>";
 echo "age : $s1->age <br>";
 echo "course : $s1->course <br>";

 echo"<br>";

 echo "id : $s2->id <br>";
 echo " name : $s2->name <br>";
 echo " age : $s2->age <br>";
 echo " course : $s2->course <br>";

 echo"<br>";

 $s3->setStudData(103,"Rohan",23,"flutter");
 $s4->setStudData(104,"Mohit",25,"DevOps");

 $s3->getStudData();
 $s4->getStudData();

 echo " <h3> Class 2 Data (Secure/private)</h3>";

 class Human{
    private $name;
    private $age;
    private $gender;
    private $nationality;
    private $is_alive;

    public function setHuman($name, $age, $gender, $nationality, $is_alive)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->nationality = $nationality;
        $this->is_alive = $is_alive;
    }

   public function getHuman()
    {
        echo "Name : $this->name <br>";
        echo "Age : $this->age <br>";
        echo "Gender : $this->gender <br>";
        echo "Nationality : $this->nationality <br>";
        echo "Alive : " . ($this->is_alive ? 'True' : 'False') . "<br>";
        echo "<br>";
    }
 }

 $h1 = new Human();
 $h2 = new Human();

 $h1->setHuman("Marcus", 30, "male", "US", true);
 $h2->setHuman("Ashely", 45, "female", "UK", false);

 $h1->getHuman();
 $h2->getHuman();

?>