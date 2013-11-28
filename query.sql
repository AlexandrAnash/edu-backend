alter table products add unique index sku_index(sku);
alter table order_products add constraint foreign key (product_id) references products(product_id) on update cascade on delete cascade;
alter table order_products add constraint foreign key (order_id) references orders(order_id) on update cascade on delete cascade;
alter table orders add constraint foreign key (seller_id) references sellers(seller_id) on update cascade on delete cascade;
alter table orders add constraint foreign key (customer_id) references customers(customer_id) on update cascade on delete cascade;