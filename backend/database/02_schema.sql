
USE scandigb_poundeasy;

CREATE TABLE currency (
  code     CHAR(3)     NOT NULL PRIMARY KEY,
  symbol   VARCHAR(5)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE category (
  name        VARCHAR(50) NOT NULL PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE product (
  product_id  VARCHAR(64) NOT NULL PRIMARY KEY,
  name        VARCHAR(255) NOT NULL,
  description TEXT         NULL,
  in_stock    TINYINT(1)   NOT NULL,
  brand       VARCHAR(100) NULL,
  category    VARCHAR(50)  NOT NULL,
  CONSTRAINT fk_product_category
    FOREIGN KEY (category) REFERENCES category(name)
      ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE gallery (
  gallery_id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id  VARCHAR(64) NOT NULL,
  image_url   TEXT NOT NULL,
  CONSTRAINT fk_gallery_product
    FOREIGN KEY (product_id) REFERENCES product(product_id)
      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE attribute_set (
  attr_set_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(100) NOT NULL,
  type        ENUM('text','swatch') NOT NULL,
  UNIQUE KEY uq_attrset_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE attribute_item (
  item_id      INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  attr_set_id  INT UNSIGNED NOT NULL,
  display_val  VARCHAR(100) NOT NULL,
  value        VARCHAR(100) NOT NULL,
  ref_id       VARCHAR(100) NOT NULL,
  CONSTRAINT fk_item_set
    FOREIGN KEY (attr_set_id) REFERENCES attribute_set(attr_set_id)
      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE product_attribute (
  product_id   VARCHAR(64)   NOT NULL,
  attr_set_id  INT UNSIGNED  NOT NULL,
  PRIMARY KEY (product_id, attr_set_id),
  CONSTRAINT fk_pa_product
    FOREIGN KEY (product_id)  REFERENCES product(product_id)
      ON DELETE CASCADE,
  CONSTRAINT fk_pa_set
    FOREIGN KEY (attr_set_id) REFERENCES attribute_set(attr_set_id)
      ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE price (
  price_id   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_id VARCHAR(64) NOT NULL,
  code       CHAR(3)     NOT NULL,
  amount     DECIMAL(10,2) NOT NULL,
  CONSTRAINT fk_price_product
    FOREIGN KEY (product_id) REFERENCES product(product_id)
      ON DELETE CASCADE,
  CONSTRAINT fk_price_currency
    FOREIGN KEY (code) REFERENCES currency(code)
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
