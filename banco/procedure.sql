-- Criando a procedure calcularCidades
DROP PROCEDURE IF EXISTS calcularCidades;
DELIMITER $$
CREATE PROCEDURE calcularCidades(IN pIDESTADO INT)
BEGIN
DECLARE vCIDADES INT;
SELECT COUNT(*) INTO vCIDADES FROM cidade WHERE (IDESTADO=pIDESTADO);
UPDATE estado SET CIDADES=vCIDADES WHERE IDESTADO=pIDESTADO;
END $$
DELIMITER ;

-- Criando a procedure calcularProdutosUnidade
DROP PROCEDURE IF EXISTS calcularProdutosUnidade;
DELIMITER $$

CREATE PROCEDURE calcularProdutosUnidade (IN pIDUNIDADE INT)
BEGIN
    DECLARE vPRODUTOS INT;
    SELECT COUNT(*) INTO vPRODUTOS FROM produto WHERE IDUNIDADE = pIDUNIDADE;
    UPDATE unidade SET PRODUTOS = vPRODUTOS WHERE IDUNIDADE = pIDUNIDADE;
END $$

DELIMITER ;
