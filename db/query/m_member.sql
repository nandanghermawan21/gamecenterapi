create table m_member(
    id varchar(12) primary key,
    username varchar(50),
    password varchar(200),
    name varchar(100),
    address varchar(200),
    phone varchar(20),
    email varchar(200),
    image_id varchar(12),
    dob date,
    point int,
    silver_ticket int,
    gold_ticket int
)

select * from m_member

select * from svc_file
where id = '617423300978'

delete from m_member
where username Is null

delete from m_member where
id = '547606781341'

update m_member
set password = '10a34637ad661d98ba3344717656fcc76209c2f8'

delete * from svc_file