<?php

class ProductDaoImp implements IProductDao
{
    private PDO $connexion;

    public function __construct(){
        $this->connexion = DBconnect::getInstance("mysql:host=localhost;dbname=courspdo","root","" )->getConnexion(); 
    }
    public  function getAllProducts(): array
    {
        $products = [];

        try {
            $statement = $this->connexion->prepare("SELECT * FROM products ;");
            $statement->execute();
            $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($resultat) > 0) {
                foreach ($resultat as $row) {
                    $products[] = new Product(
                        $row['id'],
                        $row['name'],
                        $row['numProd'],
                        $row['price'],
                        $row['description'],$row['id_cat']
                    );
                }
            }
        }
        catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        return $products;
    }

    public  function saveProduct(string $name, string $numProd, float $price, string $description,int $idcat) {
        try {
            $query = "INSERT INTO products ( `name`, `numProd`, `price`, `description`,id_cat) 
            VALUES (:name , :numProd , :price , :description, :idcat)";
            $stmt = $this->connexion->prepare($query);

            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':numProd', $numProd);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':idcat', $idcat);

            $stmt->execute();

            echo "Enregistrement réussi !";
        } catch (PDOException $e) {
            echo "Un problème est survenu";
        }
    }

    public function getProductById($id):array
    {
        $result = []; 
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            if(!$result) {
             $result= [];
           }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function deleteProduct(int $id):bool
    {
        try {

            $query = "DELETE FROM products WHERE id = :id";

            $stmt = $this->connexion->prepare($query);

            $stmt->bindValue(":id", $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return false;
    }


    public  function updateProduct(int $id,string $name, string $numProd, float $price, string $description,int $idcat)
    {
        try {
            $query  = "UPDATE products SET `name`=:name , `numProd`=:numProd , `price`=:price , `description`=:description,`id_cat`=:idcat
             WHERE id = :id ;";
            $stmt =$this->connexion->prepare($query);

            $stmt->bindValue(":id", $id);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':numProd', $numProd);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':idcat', $idcat);

            $stmt->execute();
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
        }
    }




    public function getProductByName($name):array
    {
        $products = []; 
        try {
            $query = "SELECT * FROM products WHERE name like :name ";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindValue(':name', '%'.$name.'%');
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    $products[] = new Product(
                        $row['id'],
                        $row['name'],
                        $row['numProd'],
                        $row['price'],
                        $row['description'],$row['id_cat']
                    );
                }
            }
            

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $products;
    }
    
    public function getProductBetweenPrice(float $price1,int $price2):array
    {
        $products = []; 
        try {
            $query = "SELECT * FROM `products` WHERE `price` BETWEEN :price1 AND :price2";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindValue(':price1', $price1);
            $stmt->bindValue(':price2', $price2);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if (count($result) > 0) {
                foreach ($result as $row) {
                    $products[] = new Product(
                        $row['id'],
                        $row['name'],
                        $row['numProd'],
                        $row['price'],
                        $row['description'],$row['id_cat']
                    );
                }
            }
            

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $products;
    }




    
}
