create table m_catogory(
    id varchar(10) primary key,
    name varchar(50),
    icon_url varchar(200)
)

-- add initial data
insert into m_catogory
values 
('ZKU8AIL22Z','Sembako','icon/category/ZKU8AIL22Z.png'),
('0HO2LOH66N','Makanan','icon/category/0HO2LOH66N.png'),
('V6AV54KRFM','Minuman','icon/category/V6AV54KRFM.png'),
('RMWA3GKRC5','Handphone','icon/category/RMWA3GKRC5.png'),
('VZ0G506FCP','Laptop','icon/category/VZ0G506FCP.png')

-- create sub category table
create table m_sub_category(
    id varchar(10) primary key,
    category_id varchar(10),
    name varchar(50),
    icon_url varchar(200),
    FOREIGN KEY (category_id) REFERENCES m_catogory(id)
)