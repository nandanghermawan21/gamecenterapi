create table m_product(
    id varchar(10) primary key,
    code varchar(20),
    name varchar(200),
    sub_category_id varchar(10),
    description varchar(500),
    selling_price decimal,
    silver_coint int,
    mega_ticket int,
    image varchar(500),
    FOREIGN KEY (sub_category_id) REFERENCES m_sub_category(id)
)

