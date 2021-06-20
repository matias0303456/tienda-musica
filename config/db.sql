CREATE DATABASE IF NOT EXISTS tienda_musica;
USE tienda_musica;

CREATE TABLE IF NOT EXISTS users(
id          INT AUTO_INCREMENT NOT NULL,
nick        VARCHAR(25) NOT NULL,
name        VARCHAR(255) NOT NULL,
surname     VARCHAR(255) NOT NULL,
email       VARCHAR(255) NOT NULL,
password    VARCHAR(255) NOT NULL,
role        VARCHAR (10) NOT NULL,
CONSTRAINT pk_users PRIMARY KEY (id),
CONSTRAINT uq_users UNIQUE (email)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS categories(
id          INT AUTO_INCREMENT NOT NULL,
name        VARCHAR (255) NOT NULL,
CONSTRAINT pk_categories PRIMARY KEY (id),
CONSTRAINT uq_categories UNIQUE (name)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS products(
id          INT AUTO_INCREMENT NOT NULL,
category_id INT NOT NULL,
name        VARCHAR (255) NOT NULL,
description MEDIUMTEXT NOT NULL,
price       INT NOT NULL,
stock       INT NOT NULL,
updated_at  DATETIME,
CONSTRAINT pk_products PRIMARY KEY (id),
CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories (id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS comments(
id          INT AUTO_INCREMENT NOT NULL,
user_id     INT NOT NULL,
product_id  INT NOT NULL,
content     VARCHAR (255) NOT NULL,
created_at  DATETIME,
updated_at  DATETIME,
CONSTRAINT pk_comments PRIMARY KEY (id),
CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
CONSTRAINT fk_comments_products FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS images(
id          INT AUTO_INCREMENT NOT NULL,
product_id  INT NOT NULL,
path        VARCHAR (255) NOT NULL,
CONSTRAINT pk_images PRIMARY KEY (id),
CONSTRAINT fk_images_products FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS carts(
id          INT AUTO_INCREMENT NOT NULL,
user_id     INT NOT NULL,
product_id  INT NOT NULL,
amount      INT (255) NOT NULL,
total       INT NOT NULL,
CONSTRAINT pk_carts PRIMARY KEY (id),
CONSTRAINT fk_carts_users FOREIGN KEY (user_id) REFERENCES users (id),
CONSTRAINT fk_carts_products FOREIGN KEY (product_id) REFERENCES products (id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS orders(
id          INT AUTO_INCREMENT NOT NULL,
user_id     INT NOT NULL,
product_id  INT NOT NULL,
amount      INT NOT NULL,
total       INT NOT NULL,
destination VARCHAR (255) NOT NULL,
contact     VARCHAR (255) NOT NULL,
status      VARCHAR (255),
created_at  DATETIME,
updated_at  DATETIME,
CONSTRAINT pk_orders PRIMARY KEY (id),
CONSTRAINT fk_orders_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
)ENGINE=InnoDb;







