create database if not exists m18_test;

create table m18_test.links
(
    id      int not null primary key auto_increment,
    url     varchar(255),
    code    varchar(12),
    created datetime default now()
);