<?php

class ClasseMarca
{
    private $idMarca;
    private $nome;
    private $produtos;

    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;
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

    public function inserirMarca($nome)
    {
        require("conexaobd.php");
        $comando = "SELECT inserirMarca(:nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function alterarMarca($idMarca, $nome)
    {
        require("conexaobd.php");
        $comando = "SELECT alterarMarca(:idMarca, :nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idMarca", $idMarca);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();

        $resultado = null;

        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function excluirMarca($idMarca)
    {
        require("conexaobd.php");
        $comando = "SELECT excluirMarca(:idMarca) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idMarca", $idMarca);
        $stmt->execute();
        $resultado = null;
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    public function consultarMarcas($idMarca)
    {
        try {
            require("conexaobd.php");
            $consulta = "SELECT * FROM viewMarcas WHERE IDMARCA = :idMarca";
            $stmt = $pdo->prepare($consulta);
            $stmt->bindParam(":idMarca", $idMarca);
            $stmt->execute();
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($linha) {
                $this->idMarca = $linha['IDMARCA'];
                $this->nome = $linha['NOME'];
            }
        } catch (PDOException $e) {
            return "Erro ao consultar marca: " . $e->getMessage();
        }
    }

    public function listarMarcas()
    {
        try {
            require("conexaobd.php");
            $consulta = "SELECT * FROM viewMarcas";
            $stmt = $pdo->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erro ao listar marcas: " . $e->getMessage();
        }
    }
}
