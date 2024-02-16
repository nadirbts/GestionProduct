<?php

class CategoryDaoImp implements ICategoryDao
{
    private PDO $connexion;

    public function __construct()
    {
        $this->connexion = DBconnect::getInstance("mysql:host=localhost;dbname=courspdo", "root", "")->getConnexion();
    }
    public function getAllCategory(): array
    {
        $categ = [];

        try {
            $statement = $this->connexion->prepare("SELECT * FROM category ;");
            $statement->execute();
            $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($resultat) > 0) {
                foreach ($resultat as $row) {
                    $categ[] = new Category(
                        $row['id'],
                        $row['label'],
                    );
                }
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        return $categ;
    }


    public function getCategoryById($id): array
    {
        $result = null;
        try {
            $query = "SELECT * FROM category WHERE id = :id";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

}
