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

/* alterações feitas no banco dia 22/09 */
alter table professor add imagemProfessor varchar(50);
update professor set imagemProfessor = 'Imagens/fallen.png' where codProf = '3';
alter table professor add codTurma int(10);
alter table professor add foreign key (codTurma) references turmas(codTurma);
alter table turmas modify nomeTurma varchar(50) NOT NULL;
alter table professor add nomeTurma varchar (50);
alter table professor add foreign key (nomeTurma) references turmas(nomeTurma);
insert into turmas (codTurma,nomeTurma) values('1', '6-ANO-A');
update professor set codTurma = '1' where codProf = '3';
update professor set nomeTurma = '6-ANO-A' where codProf = '3';
/* alterações feitas no banco dia 22/09 */

/* alterações feitas no banco dia 02/10 */
alter table professor auto_increment = 1;
alter table responsaveis change `(FK)codAluno` FKscodAluno int(11) NOT NULL;
alter table responsaveis change `FKscodAluno` FKcodAluno int(11) NOT NULL;
alter table responsaveis change `FKcodAluno` codAluno int(11) NOT NULL;
alter table responsaveis change `FKsenhaAluno` senhaAluno varchar(60) DEFAULT NULL;
alter table responsaveis add foreign key (codAluno) references estudante(codAluno);
alter table responsaveis add foreign key (senhaAluno) references estudante(senhaAluno);
/* alterações feitas no banco dia 02/10 */

/* alterações feitas no banco dia 25/10 */
CREATE TABLE responsaveis (
  codResponsavel int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  cpfMae bigint(12) NOT NULL,
  rgMae bigint(12) NOT NULL,
  codAluno int(11)NOT NULL,
  senhaAluno int(11) NOT NULL,
  nomeResponsavel varchar(60) DEFAULT NULL,
  senhaResponsavel varchar(60) DEFAULT NULL,
  FOREIGN KEY (codAluno) REFERENCES estudante(codAluno),
  FOREIGN KEY (senhaAluno) REFERENCES estudante(codAluno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/* alterações feitas no banco dia 25/10 */

/* alterações feitas no banco dia 26/10 */
/*create table acervo(
  codArquivo bigint(60) primary key NOT NULL auto_increment,
  arquivo longblob NOT NULL,
  codAluno int(11) NOT NULL,
  senhaAluno varchar(60) NOT NULL,
  senhaProf varchar(60) NOT NULL,
  codProf int(11) NOT NULL,
  foreign key (codAluno) references estudante(codAluno),
  foreign key (senhaAluno) references estudante(senhaAluno),
  foreign key (codProf) references professor(codProf),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;*/
/* alterações feitas no banco dia 26/10 */

/* alterações feitas no dia 03/11 */
CREATE TABLE `acervo` (
  `codArquivo` int(11) NOT NULL,
  `arquivo` varchar(40) NOT NULL,
  `dataUp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `acervo`
  ADD PRIMARY KEY (`codArquivo`);
  
  ALTER TABLE `acervo`
  MODIFY `codArquivo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
/* alterações feitas no dia 03/11 */

/* alterações feitas no dia 08/11 */
alter table acervo add nome varchar(150);
/* alterações feitas no dia 08/11 */

update estudante set imagemEstudante = 'Imagens/kevin.png' where codAluno = '4';

insert into disciplina (codDisciplina, nomeDisciplina) values ('1', 'Matemática');

insert into estudante (imagemEstudante) values ("c:/xampp/htdocs/Escola_TCC/Imagens/kevin.png");

select * from armazinfo;

/* tiaguin */ 

insert into disciplina (nomeDisciplina) values ('Matematica'), ('Portugues'), ('Historia'), ('Geografia');


create table turmas (
	cod int(11) primary key not null auto_increment,
    codTurma varchar(20),
    nomeTurma varchar(60),
    tempPorAula int(11),
    intervalo int(11)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

select * from turmas;
describe turmas;

alter table estudante add column turma int(11);
alter table estudante add foreign key (turma) references turmas(cod);

/* comandos para teste */
update estudante set turma = '1' where codAluno = ('2','3','4');

insert into turmas (codTurma,nomeTurma,tempPorAula,intervalo) values ('A', 'Informática para internet', '50', '20');

create table turmaaDisciplinas (
	cod int(11) primary key not null auto_increment,
	disciplinas int(11),
    professores int(11),
    extraProf int(11)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

insert into turmaadisciplinas (disciplinas, professores, extraProf) values ('2', '2' , '3');

select * from turmaadisciplinas;
drop table turmaadisciplinas;

create table turmaaHorario (
	cod int(11) primary key not null auto_increment,
    seg int(11),
    ter int(11),
    quar int(11),
    horario varchar(30) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

drop table turmaaHorario;
insert into turmaahorario (seg, ter, quar, horario) values ('2','2','3','7:30');



select * from turmaahorario;
drop table horarioturmaa;
drop table disciplinasturmaa;

SELECT MIN(cod) AS menorCod, MAX(cod) AS maiorCod FROM turmas;
SELECT nomeTurma, codTurma FROM turmas WHERE cod = 31;

SELECT MIN(codAluno) AS menorCodAluno, MAX(codAluno) AS maiorCodAluno FROM estudante WHERE turma = '33';
UPDATE estudante SET turma = '32' WHERE codAluno = '8';

/* Criar linha de alunos sem turma */
insert into turmas (cod, codTurma, nomeTurma, tempPorAula, intervalo) values ('0','0', 'Sem Turma','00','00');
describe turmas;
describe estudante;
select * from estudante where turma = '33';
select * from turmas;
UPDATE horarioturmaa SET seg = 7 WHERE cod = 1;

 SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = '2';
 
 SELECT MIN(cod) AS minCodDisciplina, MAX(cod) AS maxCodDisciplina FROM disciplinasturmai;
describe disciplina;
SELECT * FROM disciplina;

ALTER TABLE estudante add column turma int(11);
alter table estudante add foreign key turma references turmas(codTurma);



describe estudante;
describe disciplina;

create table notas (
 cod int(11) not null primary key,
 aluno int(11),
 disciplina int(11),
 n1 int(11),
 n2 int(11),
 n3 int(11),
 n4 int(11),
 final int(11)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;