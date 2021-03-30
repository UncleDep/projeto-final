USE Calendario;
# DROP DATABASE CALENDARIO;


# CPFs validos (apenas criar usuários com os cpfs incluídos aqui)

INSERT INTO TIPO_USUARIO VALUES('1', 1);
INSERT INTO TIPO_USUARIO VALUES('2', 2);
INSERT INTO TIPO_USUARIO VALUES('3', 1);
INSERT INTO TIPO_USUARIO VALUES('4',2);
INSERT INTO TIPO_USUARIO VALUES('5', 1);

# Usuarios teste

INSERT INTO USUARIO VALUES('a@a.a', 'b', 'c', 'Fulano', 'da Silva', '2021-03-30 00:00:00', 1, 1); #aluno
INSERT INTO USUARIO VALUES('b@b.b', 'c', 'd', 'Ciclano', 'Lima', '2021-03-30 00:00:00', 2, 2); #professor

# Turmas teste

INSERT INTO TURMA VALUES('3INFO');
INSERT INTO TURMA VALUES('3ENF');
INSERT INTO TURMA VALUES('3AUTO');
INSERT INTO TURMA VALUES('2INFO');
INSERT INTO TURMA VALUES('2ENF');
INSERT INTO TURMA VALUES('2AUTO');
INSERT INTO TURMA VALUES('1INFO');
INSERT INTO TURMA VALUES('1ENF');
INSERT INTO TURMA VALUES('1AUTO');

# Matriculas

INSERT INTO MATRICULA_TURMA VALUES(NULL, '3INFO', '1');
#INSERT INTO MATRICULA_TURMA VALUES(NULL, '3INFO', '2');
#INSERT INTO MATRICULA_TURMA VALUES(NULL, '2INFO', '2');
#INSERT INTO MATRICULA_TURMA VALUES(NULL, '1INFO', '2');

# Disciplinas teste

INSERT INTO DISCIPLINA VALUES('ARQ', 'Arquitetura de computadores', '2');
INSERT INTO DISCIPLINA VALUES('SO', 'Arquitetura de sistemas operacionais', '2');

# Matriculas

INSERT INTO MATRICULA_DISCIPLINA VALUES(NULL, '1', 'ARQ');
INSERT INTO MATRICULA_DISCIPLINA VALUES(NULL, '2', 'ARQ');
INSERT INTO MATRICULA_DISCIPLINA VALUES(NULL, '2', 'SO');

# Selects

select * from usuario;
select * from turma;
select * from matricula_turma;
select * from disciplina;
select * from matricula_disciplina;

select * from usuario, tipo_usuario where usuario.cpf = tipo_usuario.cpf;

