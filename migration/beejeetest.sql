create or replace schema if not exists beejeetest collate utf8_general_ci;

create or replace table if not exists tasks
          (
              id int(10) auto_increment
              primary key,
              username varchar(32) not null,
              email varchar(100) null,
              description varchar(350) not null,
              isModified tinyint(1) default 0 not null,
              isDone tinyint(1) default 0 null
              );

