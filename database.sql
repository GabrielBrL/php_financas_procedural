create table receitas_despesas
(
	`id` mediumint not null auto_increment,
    `usuario` varchar(20) not null,
    `descricao` varchar(80) not null,
    `tipo` char(2) not null,
    `data` date not null,
    `valor` float not null,
    primary key(`id`)
);

create table usuarios_autorizados
(
	`usuario` varchar(20) not null,
    `senha` varchar(20) not null,
    primary key(`usuario`)
);
