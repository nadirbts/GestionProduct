<?php

interface ICategoryDao
{
    function getAllCategory(): array;

    function getCategoryById(int $id): array;
}