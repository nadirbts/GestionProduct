<?php
class Product
{
    private int $id;
    private string $name;
    private string $numProd;
    private float $price;

    private string $description;
    private int $idCat;

    

    public function __construct(int $id, string $name,
     string $numProd, float $price, string $description,int $idCat)
    {
        $this->id = $id;
        $this->name = $name;
        $this->numProd = $numProd;
        $this->price = $price;
        $this->description = $description;
        $this->idCat = $idCat;
    }
    public function __toString()
    {
        return "<br>  Nom : " . $this->name .
            '<br> Numero du produit : ' . $this->numProd .
            '<br>  Prix: ' . $this->price .' $'.
            '<br>  Description :' . $this->description .
            " <br>  Id: " . $this->id ." <br>  Id Categorie: " . $this->idCat . '<br>'
            ;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of numProd
     *
     * @return string
     */
    public function getNumProd(): string
    {
        return $this->numProd;
    }

    /**
     * Set the value of numProd
     *
     * @param string $numProd
     *
     * @return self
     */
    public function setNumProd(string $numProd): self
    {
        $this->numProd = $numProd;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of idCat
     *
     * @return int
     */
    public function getIdCat(): int
    {
        return $this->idCat;
    }

    /**
     * Set the value of idCat
     *
     * @param int $idCat
     *
     * @return self
     */
    public function setIdCat(int $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }
}
