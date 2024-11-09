<?php

class ClasseUnidade
{
    private $idUnidade;
    private $nome;
    private $produtos;

    public function getIdUnidade()
    {
        return $this->idUnidade;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    public function setIdUnidade($idUnidade)
    {
        $this->idUnidade = $idUnidade;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
    }   

    public function __construct() {}

    public function inserirUnidade($nome)
    {
        require("conexaobd.php");
        $comando = "SELECT inserirUnidade(:nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function alterarUnidade($idUnidade, $nome)
    {
        require("conexaobd.php");
        $comando = "SELECT alterarUnidade(:idUnidade, :nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idUnidade", $idUnidade);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();

        $resultado = null;

        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function excluirUnidade($idUnidade)
    {
        require("conexaobd.php");
        $comando = "SELECT excluirUnidade(:idUnidade) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idUnidade", $idUnidade);
        $stmt->execute();
        $resultado = null;
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function consultarUnidades($idUnidade)
    {
        try {
            require("conexaobd.php");
            $consulta = "SELECT * FROM viewUnidades WHERE IDUNIDADE = :idUnidade";
            $stmt = $pdo->prepare($consulta);
            $stmt->bindParam(":idUnidade", $idUnidade);
            $stmt->execute();
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($linha) {
                $this->idUnidade = $linha['IDUNIDADE'];
                $this->nome = $linha['NOME'];
            }
        } catch (PDOException $e) {
            return "Erro ao consultar unidade: " . $e->getMessage();
        }
    }

    public function listarUnidades()
    {
        try {
            require("conexaobd.php");
            $consulta = "SELECT * FROM viewUnidades";
            $stmt = $pdo->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erro ao listar unidades: " . $e->getMessage();
        }
    }
}
