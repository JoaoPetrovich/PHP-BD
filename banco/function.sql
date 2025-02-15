-- FUNCTIONS

-- Function inserirEstado

DROP FUNCTION IF EXISTS inserirEstado;
DELIMITER $$                             
CREATE FUNCTION inserirEstado (pSIGLA VARCHAR(2), pNOME VARCHAR(50)) RETURNS TEXT DETERMINISTIC
BEGIN
    DECLARE resultado INT;
    DECLARE textoResultado TEXT;

    -- Verificar se a sigla tem exatamente 2 caracteres
    IF CHAR_LENGTH(pSIGLA) != 2 THEN
        SET resultado = 1;  -- Retorna 1 para violação da condição da sigla
        SET textoResultado = 'Erro: A sigla deve ter exatamente 2 caracteres.';
		
    -- Verificar se a sigla contém apenas letras (incluindo acentuação e cê cedilha)
    ELSEIF pSIGLA NOT REGEXP '^[A-Za-z]+$' THEN
        SET resultado = 5;  -- Retorna 5 para violação de caracteres inválidos na sigla
        SET textoResultado = 'Erro: A sigla deve conter apenas letras (incluindo acentuação e cedilha).';

    -- Verificar se o nome tem, no mínimo, 4 caracteres
    ELSEIF CHAR_LENGTH(pNOME) < 4 THEN
        SET resultado = 2;  -- Retorna 2 para violação da condição do nome
        SET textoResultado = 'Erro: O nome do estado deve ter no mínimo 4 caracteres.';
    
    -- Verificar se o nome contém apenas letras, acentuação, cê cedilha e espaços
    ELSEIF pNOME NOT REGEXP '^[A-Za-zÀ-ÿ ]+$' THEN
        SET resultado = 6;  -- Retorna 6 para violação de caracteres inválidos no nome
        SET textoResultado = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha) e espaços.';

    ELSE
        -- Verificar se já existe um estado com a mesma SIGLA
        IF (SELECT COUNT(*) FROM estado WHERE SIGLA = pSIGLA) > 0 THEN
            SET resultado = 3;  -- Retorna 3 para violação da restrição UNIQUE em SIGLA
            SET textoResultado = 'Erro: Já existe um estado cadastrado com essa sigla.';

        -- Verificar se já existe um estado com o mesmo NOME
        ELSEIF (SELECT COUNT(*) FROM estado WHERE NOME = pNOME) > 0 THEN
            SET resultado = 4;  -- Retorna 4 para violação da restrição UNIQUE em NOME
            SET textoResultado = 'Erro: Já existe um estado cadastrado com esse nome.';
        
        ELSE
            -- Tentar inserir o novo estado
            INSERT INTO estado (SIGLA, NOME) VALUES (pSIGLA, pNOME);
            SET resultado = 0;  -- Retorna 0 se o INSERT for executado com sucesso
            SET textoResultado = 'Sucesso: O estado foi inserido corretamente.';
        END IF;
    END IF;

    RETURN textoResultado;  -- Retorna a mensagem com o resultado da operação
END$$
DELIMITER ;

-- Function alterarEstado

DROP FUNCTION IF EXISTS alterarEstado;
DELIMITER $$

CREATE FUNCTION alterarEstado (pIDESTADO INT, pSIGLA VARCHAR(2), pNOME VARCHAR(50)) 
RETURNS TEXT DETERMINISTIC
BEGIN
    DECLARE resultado INT;
    DECLARE textoResultado TEXT;

    -- Verificar se o estado com o ID informado existe
    IF (SELECT COUNT(*) FROM estado WHERE IDESTADO = pIDESTADO) = 0 THEN
        SET resultado = 1;
        SET textoResultado = 'Erro: O estado com o ID informado não existe.';

    -- Verificar se a sigla tem exatamente 2 caracteres
    ELSEIF CHAR_LENGTH(pSIGLA) != 2 THEN
        SET resultado = 2;
        SET textoResultado = 'Erro: A sigla deve ter exatamente 2 caracteres.';

    -- Verificar se a sigla contém apenas letras (incluindo acentuação e cedilha)
    ELSEIF pSIGLA NOT REGEXP '^[A-Za-z]+$' THEN
        SET resultado = 3;
        SET textoResultado = 'Erro: A sigla deve conter apenas letras (incluindo acentuação e cedilha).';

    -- Verificar se o nome tem, no mínimo, 4 caracteres
    ELSEIF CHAR_LENGTH(pNOME) < 4 THEN
        SET resultado = 4;
        SET textoResultado = 'Erro: O nome do estado deve ter no mínimo 4 caracteres.';

    -- Verificar se o nome contém apenas letras, acentuação, cedilha e espaços
    ELSEIF pNOME NOT REGEXP '^[A-Za-zÀ-ÿ ]+$' THEN
        SET resultado = 5;
        SET textoResultado = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha) e espaços.';

    -- Verificar se já existe um estado com a mesma SIGLA, mas com ID diferente
    ELSEIF (SELECT COUNT(*) FROM estado WHERE SIGLA = pSIGLA AND IDESTADO != pIDESTADO) > 0 THEN
        SET resultado = 6;
        SET textoResultado = 'Erro: Já existe um estado cadastrado com essa sigla.';

    -- Verificar se já existe um estado com o mesmo NOME, mas com ID diferente
    ELSEIF (SELECT COUNT(*) FROM estado WHERE NOME = pNOME AND IDESTADO != pIDESTADO) > 0 THEN
        SET resultado = 7;
        SET textoResultado = 'Erro: Já existe um estado cadastrado com esse nome.';

    ELSE
        -- Tentar atualizar o estado existente
        UPDATE estado 
        SET SIGLA = pSIGLA, NOME = pNOME 
        WHERE IDESTADO = pIDESTADO;
        SET resultado = 0; -- Retorna 0 se o UPDATE for executado com sucesso
        SET textoResultado = 'Sucesso: O estado foi atualizado corretamente.';
    END IF;

    RETURN textoResultado; -- Retorna a mensagem com o resultado da operação
END$$

DELIMITER ;

-- Function excluirEstado

DROP FUNCTION IF EXISTS excluirEstado;
DELIMITER $$

CREATE FUNCTION excluirEstado (pIDESTADO INT) RETURNS TEXT DETERMINISTIC
BEGIN
    DECLARE resultado INT;
    DECLARE textoResultado TEXT;

    -- Verificar se o estado com o ID informado existe
    IF (SELECT COUNT(*) FROM estado WHERE IDESTADO = pIDESTADO) = 0 THEN
        SET textoResultado = 'Erro: O estado com o ID informado não existe.';

    -- Verificar se há cidades cadastradas para o estado
    ELSEIF (SELECT COUNT(*) FROM cidade WHERE IDESTADO = pIDESTADO) > 0 THEN
        SET textoResultado = 'Erro: Existem cidades cadastradas para esse estado. Não é possível excluí-lo.';

    ELSE
        -- Tentar excluir o estado
        DELETE FROM estado WHERE IDESTADO = pIDESTADO;
        SET textoResultado = 'Sucesso: O estado foi excluído corretamente.';
    END IF;

    RETURN textoResultado; -- Retorna a mensagem com o resultado da operação
END$$

DELIMITER ;

-- Function inserirCidade

DROP FUNCTION IF EXISTS inserirCidade;
DELIMITER $$
CREATE FUNCTION inserirCidade (pNOME VARCHAR(50), pIDESTADO INT) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

-- Verificar se o NOME da cidade tem pelo menos 3 caracteres
IF CHAR_LENGTH(pNOME) < 3 THEN
        SET textoRetorno = 'Erro: O nome da cidade deve ter no mínimo 3 caracteres.';
		
-- Verificar se o NOME da cidade tem no macimo 50 caracteres	
		ELSEIF CHAR_LENGTH (pNOME) > 50 THEN
		SET textoRetorno = 'Erro: O nome deve ter no máximo 50 caracteres.';
		
-- Verificar se o NOME da cidade contem somente caracteres válidos (letras, com acentuação, e espaço)
ELSEIF pNOME NOT REGEXP '^[A-Za-zÀ-ÿ ]+$' THEN
        SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha) e espaços.';
		
-- Verificar se o IDESTADO existe
ELSEIF (SELECT COUNT(*) FROM estado WHERE IDESTADO = pIDESTADO) = 0 THEN
        SET textoRetorno = 'Erro: O estado indicado não existe.';

-- Verificar se o NOME + ESTADO já está cadastrado
ELSEIF (SELECT COUNT(*) FROM cidade WHERE (NOME = pNOME) AND (IDESTADO = pIDESTADO)) > 0 THEN 
SET textoRetorno = 'Erro: A cidade já está cadastrada nesse estado.';

-- inserir a cidade
ELSE 
INSERT INTO cidade (NOME, IDESTADO) VALUES (pNOME, pIDESTADO);
SET textoRetorno = 'Sucesso: A cidade foi inserida corretamente.';

END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function alterarCidade

DROP FUNCTION IF EXISTS alterarCidade;
DELIMITER $$
CREATE FUNCTION alterarCidade (pIDCIDADE INT,pNOME VARCHAR(50), pIDESTADO INT) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

-- Verificar se o NOME da cidade tem pelo menos 3 caracteres
IF CHAR_LENGTH(pNOME) < 3 THEN
        SET textoRetorno = 'Erro: O nome da cidade deve ter no mínimo 3 caracteres.';
		
-- Verificar se o NOME da cidade tem no macimo 50 caracteres	
		ELSEIF CHAR_LENGTH (pNOME) > 50 THEN
		SET textoRetorno = 'Erro: O nome deve ter no máximo 50 caracteres.';
		
-- Verificar se o NOME da cidade contem somente caracteres válidos (letras, com acentuação, e espaço)
ELSEIF pNOME NOT REGEXP '^[A-Za-zÀ-ÿ ]+$' THEN
        SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha) e espaços.';
		
-- Verificar se o IDESTADO existe
ELSEIF (SELECT COUNT(*) FROM estado WHERE IDESTADO = pIDESTADO) = 0 THEN
        SET textoRetorno = 'Erro: O estado indicado não existe.';

-- Verificar se o NOME + ESTADO já está cadastrado
ELSEIF (SELECT COUNT(*) FROM cidade WHERE (NOME = pNOME) AND (IDESTADO = pIDESTADO) and (IDCIDADE<>pIDCIDADE)) > 0 THEN 
SET textoRetorno = 'Erro: A cidade já está cadastrada nesse estado.';

-- alterar a cidade
ELSE 
UPDATE cidade SET NOME=pNOME,IDESTADO=pIDESTADO WHERE IDCIDADE=pIDCIDADE;
SET textoRetorno = 'Sucesso: A cidade foi alterada corretamente.';

END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function excluirCidade

DROP FUNCTION IF EXISTS excluirCidade;
DELIMITER $$
CREATE FUNCTION excluirCidade (pIDCIDADE INT) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF (SELECT CLIENTES FROM cidade WHERE IDCIDADE=pIDCIDADE) > 0 THEN 
SET textoRetorno = 'Erro: Há clientes cadastrados na cidade.';
ELSE 
DELETE FROM cidade WHERE IDCIDADE=pIDCIDADE;
SET textoRetorno = 'Sucesso: A cidade excluida corretamente';

END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function inserirMarca

DROP FUNCTION IF EXISTS inserirMarca;
DELIMITER $$
CREATE FUNCTION inserirMarca (pNOME VARCHAR(50)) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF CHAR_LENGTH(pNOME) < 2 THEN
SET textoRetorno = 'Erro: O nome da marca deve ter no minimo 2 caracteres.';

ELSEIF pNOME NOT REGEXP '^[A-zÀ-ÿ0-9 ]+$' THEN
SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha ). e números';

ELSEIF (SELECT COUNT(*) FROM marca WHERE NOME = pNOME) > 0 THEN 
SET textoRetorno = 'Erro: Já existe uma marca cadastrada com esse nome.';

ELSE 
INSERT INTO marca (NOME) VALUES (pNOME);
SET textoRetorno = 'Sucesso: A marca foi inserida corretamente.';

END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function alterarMarca

DROP FUNCTION IF EXISTS alterarMarca;
DELIMITER $$
CREATE FUNCTION alterarMarca (pIDMARCA INT, pNOME VARCHAR(50)) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF (SELECT COUNT(*) FROM marca WHERE IDMARCA=pIDMARCA)=0 THEN
SET textoRetorno = 'O código da marca não existe';

ELSEIF CHAR_LENGTH(pNOME) < 2 THEN
SET textoRetorno = 'Erro: O nome da marca deve ter no minimo 2 caracteres.';

ELSEIF pNOME NOT REGEXP '^[A-zÀ-ÿ0-9 ]+$' THEN
SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha ). e números';

ELSEIF (SELECT COUNT(*) FROM marca WHERE IDMARCA!=pIDMARCA AND NOME = pNOME) > 0 THEN 
SET textoRetorno = 'Erro: Já existe uma marca cadastrada com esse nome.';

ELSE 
UPDATE marca SET NOME=pNOME WHERE IDMARCA=pIDMARCA;
SET textoRetorno = 'Sucesso: A marca foi alterada corretamente.';
END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function excluirMarca

DROP FUNCTION IF EXISTS excluirMarca;
DELIMITER $$
CREATE FUNCTION excluirMarca (pIDMARCA INT) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF (SELECT COUNT(*) FROM marca WHERE IDMARCA=pIDMARCA)=0 THEN
SET textoRetorno = 'O código da marca não existe';

ELSE 
DELETE FROM marca WHERE IDMARCA=pIDMARCA;
SET textoRetorno="Sucesso: a marca foi excluida com sucesso.";
END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function inserirUnidade

DROP FUNCTION IF EXISTS inserirUnidade;
DELIMITER $$
CREATE FUNCTION inserirUnidade (pNOME VARCHAR(50)) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF CHAR_LENGTH(pNOME) < 2 THEN
SET textoRetorno = 'Erro: O nome da unidade deve ter no minimo 2 caracteres.';

ELSEIF pNOME NOT REGEXP '^[A-zÀ-ÿ0-9 ]+$' THEN
SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha ). e números';

ELSEIF (SELECT COUNT(*) FROM unidade WHERE NOME = pNOME) > 0 THEN 
SET textoRetorno = 'Erro: Já existe uma unidade cadastrada com esse nome.';

ELSE 
INSERT INTO unidade (NOME) VALUES (pNOME);
SET textoRetorno = 'Sucesso: A unidade foi inserida corretamente.';

END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function alterarUnidade

DROP FUNCTION IF EXISTS alterarUnidade;
DELIMITER $$
CREATE FUNCTION alterarUnidade (pIDUNIDADE INT, pNOME VARCHAR(50)) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF (SELECT COUNT(*) FROM unidade WHERE IDUNIDADE=pIDUNIDADE)=0 THEN
SET textoRetorno = 'O código da unidade não existe';

ELSEIF CHAR_LENGTH(pNOME) < 2 THEN
SET textoRetorno = 'Erro: O nome da unidade deve ter no minimo 2 caracteres.';

ELSEIF pNOME NOT REGEXP '^[A-zÀ-ÿ0-9 ]+$' THEN
SET textoRetorno = 'Erro: O nome deve conter apenas letras (incluindo acentuação e cedilha ). e números';

ELSEIF (SELECT COUNT(*) FROM unidade WHERE IDUNIDADE!=pIDUNIDADE AND NOME = pNOME) > 0 THEN 
SET textoRetorno = 'Erro: Já existe uma unidade cadastrada com esse nome.';

ELSE 
UPDATE unidade SET NOME=pNOME WHERE IDUNIDADE=pIDUNIDADE;
SET textoRetorno = 'Sucesso: A unidade foi alterada corretamente.';
END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Function excluirUnidade

DROP FUNCTION IF EXISTS excluirUnidade;
DELIMITER $$
CREATE FUNCTION excluirUnidade (pIDUNIDADE INT) RETURNS TEXT DETERMINISTIC
BEGIN
DECLARE textoRetorno TEXT;

IF (SELECT COUNT(*) FROM unidade WHERE IDUNIDADE=pIDUNIDADE)=0 THEN
SET textoRetorno = 'O código da unidade não existe';

ELSE 
DELETE FROM unidade WHERE IDUNIDADE=pIDUNIDADE;
SET textoRetorno="Sucesso: a unidade foi excluida com sucesso.";
END IF;

RETURN textoRetorno;
END $$
DELIMITER ;

-- Função inserirProduto
DROP FUNCTION IF EXISTS inserirProduto; 
DELIMITER $$

CREATE FUNCTION inserirProduto (
    pNOME VARCHAR(50),
    pPRECOCOMPRA DECIMAL(10,2),
    pMARGEMLUCRO DECIMAL(5,1),
    pIDMARCA INT,
    pIDUNIDADE INT
) RETURNS TEXT DETERMINISTIC 
BEGIN
    DECLARE textoRetorno TEXT;

    -- Verificar se o NOME do produto tem pelo menos 3 caracteres
    IF CHAR_LENGTH(pNOME) < 3 THEN
        SET textoRetorno = 'Erro: O nome deve ter pelo menos 3 caracteres.';

    -- Verificar se IDMARCA existe
    ELSEIF (SELECT COUNT(*) FROM marca WHERE IDMARCA = pIDMARCA) = 0 THEN
        SET textoRetorno = 'Erro: A marca indicada não existe.';

    -- Verificar se IDUNIDADE existe
    ELSEIF (SELECT COUNT(*) FROM unidade WHERE IDUNIDADE = pIDUNIDADE) = 0 THEN
        SET textoRetorno = 'Erro: A unidade indicada não existe.';

    -- Inserir o produto
    ELSE
        INSERT INTO produto (NOME, PRECOCOMPRA, MARGEMLUCRO, IDMARCA, IDUNIDADE) 
        VALUES (pNOME, pPRECOCOMPRA, pMARGEMLUCRO, pIDMARCA, pIDUNIDADE); 
        SET textoRetorno = 'Sucesso: O produto foi inserido corretamente.';
    END IF;

    RETURN textoRetorno;
END $$

DELIMITER ;

-- Função alterarProduto
DROP FUNCTION IF EXISTS alterarProduto; 
DELIMITER $$

CREATE FUNCTION alterarProduto (
    pIDPRODUTO INT,
    pNOME VARCHAR(50),
    pPRECOCOMPRA DECIMAL(10,2),
    pMARGEMLUCRO DECIMAL(5,1),
    pIDMARCA INT,
    pIDUNIDADE INT
) RETURNS TEXT DETERMINISTIC 
BEGIN
    DECLARE textoRetorno TEXT;

    -- Verificar se o NOME do produto tem pelo menos 3 caracteres
    IF CHAR_LENGTH(pNOME) < 3 THEN
        SET textoRetorno = 'Erro: O nome deve ter pelo menos 3 caracteres.';

    -- Verificar se IDMARCA existe
    ELSEIF (SELECT COUNT(*) FROM marca WHERE IDMARCA = pIDMARCA) = 0 THEN
        SET textoRetorno = 'Erro: A marca indicada não existe.';

    -- Verificar se IDUNIDADE existe
    ELSEIF (SELECT COUNT(*) FROM unidade WHERE IDUNIDADE = pIDUNIDADE) = 0 THEN
        SET textoRetorno = 'Erro: A unidade indicada não existe.';

    -- Alterar o produto
    ELSE
        UPDATE produto 
        SET 
            NOME = pNOME,
            PRECOCOMPRA = pPRECOCOMPRA,
            MARGEMLUCRO = pMARGEMLUCRO,
            IDMARCA = pIDMARCA,
            IDUNIDADE = pIDUNIDADE
        WHERE IDPRODUTO = pIDPRODUTO; 
        
        SET textoRetorno = 'Sucesso: O produto foi alterado corretamente.';
    END IF;

    RETURN textoRetorno;
END $$

DELIMITER ;

-- Função excluirProduto
DROP FUNCTION IF EXISTS excluirProduto;
DELIMITER $$

CREATE FUNCTION excluirProduto (pIDPRODUTO INT) RETURNS TEXT DETERMINISTIC
BEGIN
    DECLARE textoRetorno TEXT;

    -- Verificar se há itens comprados no produto
    IF (SELECT COMPRADOS FROM produto WHERE IDPRODUTO = pIDPRODUTO) > 0 THEN 
        SET textoRetorno = 'Erro: Foram efetuadas compras para esse produto.';

    -- Verificar se há itens vendidos no produto
    ELSEIF (SELECT VENDIDOS FROM produto WHERE IDPRODUTO = pIDPRODUTO) > 0 THEN 
        SET textoRetorno = 'Erro: Foram efetuadas vendas para esse produto.'; 

    -- Excluir o produto
    ELSE
        DELETE FROM produto WHERE IDPRODUTO = pIDPRODUTO;
        SET textoRetorno = 'Sucesso: O produto foi excluído corretamente.'; 
    END IF;

    RETURN textoRetorno;
END $$

DELIMITER ;
