<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('model/Product.php');
    require_once('utils/DBconnect.php');
    require_once('dao/IProductDao.php');
    require_once('dao/ICategoryDao.php');
    require_once('dao/imp/ProductDaoImp.php');
    
    require_once('model/Category.php');
    require_once("dao/imp/CategoryDaoImp.php");

    $product_id = $_GET['id'];

    $productsDao = new ProductDaoImp();
    $result = $productsDao->getProductById($product_id);

    $product = new Product(
        $result['id'],
        $result['name'],
        $result['numProd'],
        $result['price'],
        $result['description'],
        $result['id_cat']
    );
    ?>

    <form action="" method="post">
        <label for="name">Nom </label>
        <input type="text" name="name" value="<?= $product->getName() ?>"> <br>

        <label for="numProd">Numero Produit :</label>
        <input type="text" name="numProd" value="<?= $product->getNumProd() ?>"> <br>

        <label for="price">Prix :</label>
        <input type="number" min='0.01' step="0.01" name="price" value="<?= $product->getPrice() ?>"> <br>

        <label for="description">Description :</label>
        <textarea name="description" id="description">
        <?= $product->getDescription() ?>
        </textarea> <br>
        <label for="idcat">Choisir la categorie :</label>
        <select name="idcat" id="idcat">
            <?php
            



            $categDao = new CategoryDaoImp();
            $result = $categDao->getAllCategory();

            foreach ($result as $categ) {
                
                   $idcat = $categ->getId();
                    $label = $categ->getLabel();
                
                echo "<option value='$idcat'>$label</option>";

            }

        
            ?>

        </select>


        <input type="submit" name="submit" value="Valider les modifications">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $numProd = $_POST['numProd'];
        $description = $_POST['description'];
        $prix = $_POST['price'];
        $idcat = $_POST['idcat'];

        $productsDao->updateProduct($product_id, $name, $numProd, $prix, $description, $idcat);
        header("Location: selectionPDO.php");
    }
    ?>
</body>

</html>