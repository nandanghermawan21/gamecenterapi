create table m_member(
    id int primary key,
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

drop table m_member

select * from m_member

delete from m_member

INSERT INTO `m_member` (`id`, `username`, `password`, `name`, `address`, `phone`, `email`, `dob`, `point`, `silver_ticket`, `gold_ticket`) VALUES ('4368529071', 'string', 'string', 'string', 'string', 'string', NULL, NULL, NULL, 0, 0)