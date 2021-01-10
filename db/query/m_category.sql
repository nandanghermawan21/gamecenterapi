create table m_category(
    id varchar(10) primary key,
    name varchar(50),
    icon_url varchar(200),
    created_date datetime,
    created_by int,
    is_deleted boolean
);

-- add initial data
insert into m_category
values 
('ZKU8AIL22Z','Sembako','icon/category/ZKU8AIL22Z.png',null,null,0),
('0HO2LOH66N','Makanan','icon/category/0HO2LOH66N.png',null,null,0),
('V6AV54KRFM','Minuman','icon/category/V6AV54KRFM.png',null,null,0),
('RMWA3GKRC5','Handphone','icon/category/RMWA3GKRC5.png',null,null,0),
('VZ0G506FCP','Laptop','icon/category/VZ0G506FCP.png',null,null,0);

-- create sub category table
create table m_sub_category(
    id varchar(10) primary key,
    category_id varchar(10),
    name varchar(50),
    icon_url varchar(200),
    FOREIGN KEY (category_id) REFERENCES m_category(id)
);

