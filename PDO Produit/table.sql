DROP TABLE category,products;

 CREATE TABLE category (id int PRIMARY KEY AUTO_INCREMENT,   label Varchar(255) not null);


 
                      CREATE table products(id int  PRIMARY key AUTO_INCREMENT,
        name varchar(255) not null,	numProd varchar(5) not null unique,  price decimal(10,2) not null check (price>0), 
        description text, id_cat int not null, CONSTRAINT id_cat_prod FOREIGN KEY (id_cat) REFERENCES category(id) );

