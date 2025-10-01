USE scandigb_poundeasy;


INSERT INTO currency (code, symbol) VALUES
  ('USD', '$');


INSERT INTO category (name) VALUES
  ('all'),
  ('clothes'),
  ('tech');


INSERT INTO product
  (product_id, name, description, in_stock, brand, category)
VALUES
  ('huarache-x-stussy-le', 'Nike Air Huarache Le',
   '<p>Great sneakers for everyday use!</p>', 1, 'Nike x Stussy', 'clothes'),
  ('jacket-canada-goosee', 'Jacket',
   '<p>Awesome winter jacket</p>', 1, 'Canada Goose', 'clothes'),
  ('ps-5', 'PlayStation 5',
   '<p>A good gaming console. Plays games of PS4! Enjoy if you can buy it mwahahahaha</p>', 1, 'Sony', 'tech'),
  ('xbox-series-s', 'Xbox Series S 512GB',
   '<div><ul><li><span>Hardware‑beschleunigtes Raytracing …</span></li></ul></div>', 0, 'Microsoft', 'tech'),
  ('apple-imac-2021', 'iMac 2021',
   'The new iMac!', 1, 'Apple', 'tech'),
  ('apple-iphone-12-pro', 'iPhone 12 Pro',
   'This is iPhone 12. Nothing else to say.', 1, 'Apple', 'tech'),
  ('apple-airpods-pro', 'AirPods Pro',
   'Magic like you’ve never heard – see Apple copy.', 0, 'Apple', 'tech'),
  ('apple-airtag', 'AirTag',
   'Lose your knack for losing things.', 1, 'Apple', 'tech');


INSERT INTO gallery (gallery_id, product_id, image_url) VALUES
  ( 1,'huarache-x-stussy-le','https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_2_720x.jpg?v=1612816087'),
  ( 2,'huarache-x-stussy-le','https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_1_720x.jpg?v=1612816087'),
  ( 3,'huarache-x-stussy-le','https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_3_720x.jpg?v=1612816087'),
  ( 4,'huarache-x-stussy-le','https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_5_720x.jpg?v=1612816087'),
  ( 5,'huarache-x-stussy-le','https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_4_720x.jpg?v=1612816087'),

  ( 6,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg'),
  ( 7,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016107/product-image/2409L_61_a.jpg'),
  ( 8,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016108/product-image/2409L_61_b.jpg'),
  ( 9,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016109/product-image/2409L_61_c.jpg'),
  (10,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016110/product-image/2409L_61_d.jpg'),
  (11,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058169/product-image/2409L_61_o.png'),
  (12,'jacket-canada-goosee','https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058159/product-image/2409L_61_p.png'),

  (13,'ps-5','https://images-na.ssl-images-amazon.com/images/I/510VSJ9mWDL._SL1262_.jpg'),
  (14,'ps-5','https://images-na.ssl-images-amazon.com/images/I/610%2B69ZsKCL._SL1500_.jpg'),
  (15,'ps-5','https://images-na.ssl-images-amazon.com/images/I/51iPoFwQT3L._SL1230_.jpg'),
  (16,'ps-5','https://images-na.ssl-images-amazon.com/images/I/61qbqFcvoNL._SL1500_.jpg'),
  (17,'ps-5','https://images-na.ssl-images-amazon.com/images/I/51HCjA3rqYL._SL1230_.jpg'),

  (18,'xbox-series-s','https://images-na.ssl-images-amazon.com/images/I/71vPCX0bS-L._SL1500_.jpg'),
  (19,'xbox-series-s','https://images-na.ssl-images-amazon.com/images/I/71q7JTbRTpL._SL1500_.jpg'),
  (20,'xbox-series-s','https://images-na.ssl-images-amazon.com/images/I/71iQ4HGHtsL._SL1500_.jpg'),
  (21,'xbox-series-s','https://images-na.ssl-images-amazon.com/images/I/61IYrCrBzxL._SL1500_.jpg'),
  (22,'xbox-series-s','https://images-na.ssl-images-amazon.com/images/I/61RnXmpAmIL._SL1500_.jpg'),

  (23,'apple-imac-2021','https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/imac-24-blue-selection-hero-202104?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1617492405000'),
  (24,'apple-iphone-12-pro','https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-12-pro-family-hero?wid=940&hei=1112&fmt=jpeg&qlt=80&.v=1604021663000'),
  (25,'apple-airpods-pro','https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MWP22?wid=572&hei=572&fmt=jpeg&qlt=95&.v=1591634795000'),
  (26,'apple-airtag','https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/airtag-double-select-202104?wid=445&hei=370&fmt=jpeg&qlt=95&.v=1617761672000');


INSERT INTO attribute_set (attr_set_id, name, type) VALUES
  (1, 'Size', 'text'),
  (2, 'Color', 'swatch'),
  (3, 'Capacity', 'text'),
  (4, 'With USB 3 ports', 'text'),
  (5, 'Touch ID in keyboard', 'text');


INSERT INTO attribute_item
  (item_id, attr_set_id, display_val, value, ref_id)
VALUES
  ( 1,1,'40','40','40'),
  ( 2,1,'41','41','41'),
  ( 3,1,'42','42','42'),
  ( 4,1,'43','43','43'),
  ( 5,1,'Small','S','Small'),
  ( 6,1,'Medium','M','Medium'),
  ( 7,1,'Large','L','Large'),
  ( 8,1,'Extra Large','XL','Extra Large'),

  ( 9,2,'Green','#44FF03','Green'),
  (10,2,'Cyan','#03FFF7','Cyan'),
  (11,2,'Blue','#030BFF','Blue'),
  (12,2,'Black','#000000','Black'),
  (13,2,'White','#FFFFFF','White'),

  (14,3,'512G','512G','512G'),
  (15,3,'1T','1T','1T'),
  (16,3,'256GB','256GB','256GB'),
  (17,3,'512GB','512GB','512GB'),

  (18,4,'Yes','Yes','Yes'),
  (19,4,'No','No','No'),

  (20,5,'Yes','Yes','Yes'),
  (21,5,'No','No','No');

INSERT INTO product_attribute (product_id, attr_set_id) VALUES
  ('huarache-x-stussy-le', 1),
  ('jacket-canada-goosee', 1),

  ('ps-5', 2),
  ('ps-5', 3),

  ('xbox-series-s', 2),
  ('xbox-series-s', 3),

  ('apple-imac-2021', 3),
  ('apple-imac-2021', 4),
  ('apple-imac-2021', 5),

  ('apple-iphone-12-pro', 3),
  ('apple-iphone-12-pro', 2);

INSERT INTO price
  (price_id, product_id, code, amount)
VALUES
  (NULL,'huarache-x-stussy-le','USD',144.69),
  (NULL,'jacket-canada-goosee','USD',518.47),
  (NULL,'ps-5','USD',844.02),
  (NULL,'xbox-series-s','USD',333.99),
  (NULL,'apple-imac-2021','USD',1688.03),
  (NULL,'apple-iphone-12-pro','USD',1000.76),
  (NULL,'apple-airpods-pro','USD',300.23),
  (NULL,'apple-airtag','USD',120.57);
