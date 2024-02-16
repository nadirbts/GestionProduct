<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Personne</title>
</head>

<body>
    <form action="" method="get">

        <label for="name">Nom du produit à rechercher :</label>
        <input type="text" name="name">
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

        if (isset($_GET['name'])) {

            $name = $_GET['name'];
            $productsDao = new ProductDaoImp();
            $products = $productsDao->getProductByName($name);
            
            $categDao = new CategoryDaoImp();
            if ($products) {
                echo "<h3>Informations Produits :</h3>";
                foreach ($products as $product) {

                    $categ = $categDao->getCategoryById($product->getId());
                    echo $product.'Label :'.$categ['label'].'<hr>';

                }
            } else {
                echo "Produit  non trouvée";
            }
        }
    }
    ?>

</body>

</html>