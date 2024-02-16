<?php

 require_once('utils/DBconnect.php');
    require_once('dao/IProductDao.php');
    require_once('dao/imp/ProductDaoImp.php');


if (isset($_GET['id'])) {
    //ON fait appel a la DAO 
    // AVEC LA METHODE DELETE
    $productsDao=new ProductDaoImp();
    $productsDao->deleteProduct($_GET['id']);
    // ON FAIT UNE REDIRECTION 
    // VERS LA PAGE SELECTIONPDO
    header('Location: selectionPDO.php');
}
