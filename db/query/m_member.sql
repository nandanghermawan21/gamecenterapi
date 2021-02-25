create table m_member(
    id varchar(12) primary key,
    username varchar(50),
    password varchar(200),
    name varchar(100),
    address varchar(200),
    phone varchar(20),
    email varchar(200),
    image_id int,
    dob date,
    point int,
    silver_ticket int,
    gold_ticket int
)