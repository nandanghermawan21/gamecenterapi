
create table m_voucher(
    id varchar(16) primary key,
    count int,
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