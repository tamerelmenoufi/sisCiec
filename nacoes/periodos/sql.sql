CREATE TABLE `wmsuplet_cnery`.`periodos` (
`codigo` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`descricao` VARCHAR( 255 ) NOT NULL ,
`data_inicial` DATE NOT NULL ,
`data_final` DATE NOT NULL
) ENGINE = MYISAM ;