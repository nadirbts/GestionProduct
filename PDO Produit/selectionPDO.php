<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require_once('utils/DBconnect.php');
    require_once('dao/IProductDao.php');
    require_once('dao/ICategoryDao.php');

    require_once('dao/imp/ProductDaoImp.php');
    require_once('model/Product.php');
    require_once('model/Category.php');
    require_once('dao/imp/CategoryDaoImp.php');

    $productsDao = new ProductDaoImp();
    $products = $productsDao->getAllProducts();
    ?>
    <fieldset>
    <form action="" method="get">
        <legend>Recherche par nom:</legend>
        <label for="name">Nom du produit à rechercher :</label>
        <input type="text" name="name"><br>
        <input type="submit" name="submit" value="Rechercher">

    </form>
    <hr>
    <form action="" method="get">
        <legend>Recherche par Prix:</legend>
        <label for="price1">Prix Min du produit à rechercher :</label>
        <input type="number" name="price1" min='0.01' step="0.01">
        <br>
        <label for="price2">Prix Max du produit à rechercher :</label>
        <input type="number" min='0.01' step="0.01" name="price2"> <br>

        <input type="submit" name="submit" value="Rechercher">

    </form>
</fieldset>


<fieldset>
    <?php
     $categDao = new CategoryDaoImp();
      $productsDao = new ProductDaoImp();
    foreach ($products as $product) {
        $categ = $categDao->getCategoryById($product->getIdCat());
        echo $product.'Label :'.$categ['label'].'<br>';
        ?>
        <a href="delete.php?id=<?= $product->getId() ?> ">
            <button>Supprimer</button>
        </a>
        <a href="edit.php?id=<?= $product->getId() ?>">
            <button>Editer</button><hr>
        </a>

        <?php
    }
    echo '</fieldset><br><br><fieldset>';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['name'])) {
            $name = $_GET['name'];
          
           

            $products = $productsDao->getProductByName($name);
            if ($products) {
                echo "<h3>Informations Produits :</h3>";
                foreach ($products as $product) {
                    $categ = $categDao->getCategoryById($product->getIdCat());
                    echo $product.'Label :'.$categ['label'].'<hr>';

                }
            } else {
                echo "Produit  non trouvée";
            }
        } else if (isset($_GET['price1']) && isset($_GET['price2'])) {


            $prixMin = $_GET['price1'];
            $prixMax = $_GET['price2'];

           
            $products = $productsDao->getProductBetweenPrice($prixMin, $prixMax);

            if ($products) {
                echo "<h3>Informations Produits :</h3>";
                foreach ($products as $product) {
                    $categ = $categDao->getCategoryById($product->getIdCat());
                    echo $product.'Label :'.$categ['label'].'<hr>';
                }
            } else {
                echo "Produit  non trouvée";
            }
        }

    }





    ?>
    </fieldset>

</body>

</html>