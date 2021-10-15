create database Escola_TCC;
use escola_tcc;


alter table estudante modify senhaAluno varchar(60);
alter table professor modify senhaProf varchar (60);
alter table administrador modify senhaAdm varchar(60);

alter table responsaveis modify senhaAluno varchar(60);
alter table responsaveis add nomeResponsavel varchar(60);
alter table responsaveis add senhaResponsavel varchar(60);


/* alguns insert para testar a tabela notas */
INSERT INTO armazinfo (notaAluno, mediaBimestre, frequenciaAluno, FKcodDisciplina)
VALUES (5, 7,0.89,1);

INSERT INTO armazinfo (notaAluno, mediaBimestre, frequenciaAluno, FKcodDisciplina)
VALUES (8, 5 ,0.3,1);

INSERT INTO armazinfo (notaAluno, mediaBimestre, frequenciaAluno, FKcodDisciplina)
VALUES (4, 4,0.52,2);

/* alteração nas tabelas seguintes */
alter table armazinfo change `(FK)codDisciplina` FKcodDisciplina varchar(45) NOT NULL;
alter table responsaveis change `(FK)senhaAluno` FKsenhaAluno varchar(20) NOT NULL;
alter table estudante add imagemEstudante BLOB;

alter table estudante drop column imagemEstudante;
alter table estudante add imagemEstudante varchar(50);
alter  table professor drop column codDisciplina;

/* alterações feitas no banco dia 20/09 */
alter table professor add codDisciplina int(11);
alter table professor  add foreign key (codDisciplina) references disciplina(codDisciplina);
/* alterações feitas no banco dia 20/09 */

update estudante set imagemEstudante = 'Imagens/kevin.png' where codAluno = '4';

insert into disciplina (codDisciplina, nomeDisciplina) values ('1', 'Matemática');

insert into estudante (imagemEstudante) values ("c:/xampp/htdocs/Escola_TCC/Imagens/kevin.png");

select * from armazinfo;