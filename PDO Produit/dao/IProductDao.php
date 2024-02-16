<?php

interface IProductDao{
    function getAllProducts():array;
    function saveProduct(string $name, string $numProd, float $price, string $description,int $idcat);
    function updateProduct(int $id,string $name, string $numProd, float $price, string $description,int $idcat);
    function deleteProduct(int $id):bool;
    function getProductById(int $id):array;
    function getProductByName(string $name):array;
    function getProductBetweenPrice(float $price1,int $price2):array;
}