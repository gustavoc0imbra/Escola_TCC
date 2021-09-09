
create database Escola_TCC;
use escola_tcc;


alter table estudante modify senhaAluno varchar(60);
alter table professor modify senhaProf varchar (60);
alter table administrador modify senhaAdm varchar(60);

alter table responsaveis modify senhaAluno varchar(60);
alter table responsaveis add nomeResponsavel varchar(60) after senhaAluno;
alter table responsaveis add senhaResponsavel varchar(60) after nomeResponsavel;
