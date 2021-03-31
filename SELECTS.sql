USE Calendario;
DROP DATABASE CALENDARIO;

select * from usuario;
select * from turma;
select * from matricula_turma;
select * from disciplina;
select * from matricula_disciplina;
select * from atividade;

select * from usuario, tipo_usuario where usuario.cpf = tipo_usuario.cpf;
select * from atividade_turma;
select * from atividade_disciplina;

SELECT * FROM ATIVIDADES_DA_DISCIPLINA;
SELECT * FROM ATIVIDADES_DA_TURMA;

SELECT count(DISTINCT ID) as COUNT FROM TURMA WHERE ID IN('1info', '2info', 'tur3');
SELECT count(DISTINCT ID) as COUNT FROM TURMA WHERE ID IN('1info', '2info', '3enf');
SELECT count(DISTINCT ID) as COUNT, count(DISTINCT ID) as COUNT2 FROM TURMA WHERE ID IN('1info', '2info', '3enf');

SELECT * FROM ATIVIDADES_DA_TURMA INNER JOIN MATRICULA_TURMA ON ATIVIDADES_DA_TURMA.TURMA = MATRICULA_TURMA.TURMA WHERE USUARIO='2';
SELECT * FROM ATIVIDADES_DA_DISCIPLINA INNER JOIN MATRICULA_DISCIPLINA ON ATIVIDADES_DA_DISCIPLINA.DISCIPLINA = MATRICULA_DISCIPLINA.DISCIPLINA WHERE USUARIO='2';