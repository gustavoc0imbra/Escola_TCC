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