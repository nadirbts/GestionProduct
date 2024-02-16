<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <label for="name">Nom </label>
        <input type="text" name="name"> <br>

        <label for="numProd">Numero Produit :</label>
        <input type="text" name="numProd"> <br>

        <label for="price">Prix :</label>
        <input type="number" min='0.01' step="0.01" name="price"> <br>

        <label for="description">Description :</label>
        <textarea name="description" id="description" cols="30" rows="10">
        </textarea> <br>


        <label for="idcat">Choisir la categorie :</label>
        <select name="idcat" id="idcat">
            <?php
            require_once('model/Product.php');
            require_once('utils/DBconnect.php');
            require_once('dao/IProductDao.php');
            require_once('dao/ICategoryDao.php');
            require_once('dao/imp/ProductDaoImp.php');
            
            require_once('model/Category.php');
            require_once("dao/imp/CategoryDaoImp.php");

            $categDao = new CategoryDaoImp();
            $result = $categDao->getAllCategory();
            foreach ($result as $categ) {

                $idcat = $categ->getId();
                $label = $categ->getLabel();

                echo "<option value='$idcat'>$label</option>";
            }
            ?>
        </select>



        <input type="submit" value="Envoyer">
    </form>

    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (
            isset($_POST['name'])
            && isset($_POST['numProd'])
            && isset($_POST['description'])
            && isset($_POST['price'])
            && isset($_POST['idcat'])
        ) {

            $name = $_POST['name'];
            $numProd = $_POST['numProd'];
            $description = $_POST['description'];
            $prix = $_POST['price'];
            $idcat = $_POST['idcat'];


            $productsDao = new ProductDaoImp();
            $productsDao->saveProduct($name, $numProd, $prix, $description, $idcat);
        }
    }
    ?>
</body>

</html>