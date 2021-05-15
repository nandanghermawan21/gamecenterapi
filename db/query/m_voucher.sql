
create table m_voucher(
    id varchar(12) primary key,
    count int,
    used int,
    point int,
    silver_ticket int,
    gold_ticket int,
    start_date datetime,
    end_date datetime,
    create_date datetime
)

create table trx_voucher(
    noref varchar(50) primary,
    member_id varchar(12),
    voucher_id varchar(12),
    used_date datetime,
)

select * from m_voucher
where id = '951750264326'

delete from m_voucher

drop table m_voucher

select * from m_member