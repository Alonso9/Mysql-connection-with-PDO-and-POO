<?php 

require_once("conn.php");

class Products{

    private $id;
    private $id_section;
    private $name;
    private $desciption;
    private $cost;
    private $img;

    const TABLE = "productos"; //Name of the table

    public function get_name(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }

     function getDescription(){
        return $this->name;
    }

     function getCost(){
        return $this->cost;
    }

    function getImg(){
        return $this->img;
    }

    public function __construct($id_section, $name, $desciption, $img, $cost, $id=Null){
        $this->id_section = $id_section;
        $this->name = $name;
        $this->id = $id;
        $this->img = $img;
        $this->desciption = $desciption;
        $this->cost = $cost;
    }

    public function get_all_elements(){
        $conn = new Connection();

        $query = $conn->prepare("SELECT * FROM ". self::TABLE);
        $query->execute();
        return $query->fetchAll();
    }

    public function save(){

        $conn = new Connection();

        $query = $conn->prepare("INSERT INTO ". self::TABLE. " (id, id_section, name, description, img, cost) VALUES(NULL, :id_section, :name, :desciption, NULL, :cost)");
            $query->bindParam(":id_section",$this->id_section);
            $query->bindParam(":name",$this->name);
            $query->bindParam(":desciption",$this->desciption);
            $query->bindParam(":cost",$this->cost);
            $query->execute();
            $this->id = $conn->lastInsertId();


    }


    public function delete($id){
        $conn = new Connection();

        $query = $conn->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $query->bindParam(":id",$id);
        $query->execute();
    }
    
    public function search($id){
        $conn = new Connection();

        $query = $conn->prepare("SELECT * FROM " . self::TABLE . " WHERE id = :id");
        $query->bindParam(":id",$id);
        $query->execute();
        return $query->fetchAll();
    }
}

/*$products = new Products( 7,"Cream","Foot Cream",NULL,150); //Create the object and pass the parameters
echo "<br>";

echo "<br>";
echo "<br>";

print_r(products::search(11)); //Search by id

products::delete(6); //Delete by id
echo "<br>";
echo "<br>";

$products->save(); //save the obj with the parameters
echo $products->getId();
echo "<br>";
*/
//print_r(products::get_all_elements()); //Print all elements in the table

?>
