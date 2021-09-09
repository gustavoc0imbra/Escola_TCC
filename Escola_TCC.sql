create database Escola_TCC;

insert into estudante (codAluno, nomeAluno, senhaAluno, datanascAluno, RG, CPF, telefoneAluno, bairroAluno, ruaAluno, cidadeAluno) 
values ('1', 'Gustavo Coimbra', '123', '2004-03-16', '00000000', '480892588-59', '4002-8922', 'Vila Cerqueira', 'Rua Benedito Storani', 'Américo Brasiliense');

create table turmas (
codTurma int not null,
nomeTurma varchar(35) not null,
primary key (`codTurma`);
