<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Personne</title>
</head>

<body>

    <!-- Formulaire pour saisir l'ID de la personne à rechercher -->
    <form action="" method="get">

        <label for="id_product">Id de la personne à rechercher :</label>
        <input type="number" name="id_product">
        <input type="submit" name="submit" value="Rechercher">

    </form>

    <?php
     require_once('utils/DBconnect.php');
     require_once('dao/IProductDao.php');
     require_once('dao/imp/ProductDaoImp.php');
     require_once('model/Product.php');
     require_once('dao/ICategoryDao.php');
     require_once('model/Category.php');
     require_once('dao/imp/CategoryDaoImp.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['id_product'])) {

            $id = $_GET['id_product'];
            $productsDao=new ProductDaoImp();
            $result = $productsDao->getProductById($id);


            

            if ($result) {
                $product = new Product(
                $result['id'],
                $result['name'],  
                $result['numProd'],
                $result['price'],
                $result['description'],
                $result['id_cat'],
            );
                echo "<h3>Informations Produits :</h3>";
                $categDao = new CategoryDaoImp();
                $categ = $categDao->getCategoryById($product->getId());
                echo $product.'Label :'.$categ['label'].'<hr>';
            } else {
                echo "Personne non trouvée";
            }
        }
    }
    ?>

</body>

</html>
