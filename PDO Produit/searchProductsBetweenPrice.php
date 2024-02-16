<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Personne</title>
</head>

<body>
    <form action="" method="get">

        <label for="price1">Prix Min du produit à rechercher :</label>
        <input type="number" name="price1" min='0.01' step="0.01">
        <br>
        <label for="price2">Prix Max du produit à rechercher :</label>
        <input type="number" min='0.01' step="0.01" name="price2" > <br>

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

        if (isset($_GET['price1']) && isset($_GET['price2'])) {

            $prixMin = $_GET['price1'];
            $prixMax = $_GET['price2'];

            $productsDao = new ProductDaoImp();
            $products = $productsDao->getProductBetweenPrice($prixMin, $prixMax);
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