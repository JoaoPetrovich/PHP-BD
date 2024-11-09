<?php
class ClasseEstado
{
    /* Atributos */

    private $idEstado;
    private $nome;
    private $sigla;
    private $cidades;

    /* Getters */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSigla()
    {
        return $this->sigla;
    }

    public function getCidades()
    {
        return $this->cidades;
    }

    /* Setters */

    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }
    public function setCidades($cidades)
    {
        $this->cidades = $cidades;
    }

    // Método construtor
    public function __construct() {}

    /*Implementar od métodos do CRUD */

    /* Método inserirEstado */
    public function inserirEstado($sigla, $nome)
    {
        require("conexaobd.php");
        $comando = "SELECT inserirEstado(:sigla,:nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":sigla", $sigla);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método alterarEstado */
    public function alterarEstado($idEstado, $sigla, $nome)
    {
        require("conexaobd.php");
        $comando = "SELECT alterarEstado(:idEstado, :sigla, :nome) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idEstado", $idEstado);
        $stmt->bindParam(":sigla", $sigla);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();

        $resultado = null;

        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método excluirEstado */
    public function excluirEstado($idEstado)
    {
        require("conexaobd.php");
        $comando = "SELECT excluirEstado(:idEstado) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idEstado", $idEstado);
        $stmt->execute();
        $resultado = null;
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método consultarEstado */
    public function consultarEstados($idEstado)
    {
        require("conexaobd.php");
        $consulta = "SELECT * FROM viewEstados WHERE IDESTADO=:idEstado";
        $stmt = $pdo->prepare($consulta);
        $stmt->bindParam(":idEstado", $idEstado);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $this->idEstado = $linha["IDESTADO"];
            $this->nome = $linha["NOME"];
            $this->sigla = $linha["SIGLA"];
        }
    }

    /* Método listarEstados*/
    public function listarEstados()
    {
        require("conexaobd.php");
        $consulta = "SELECT * FROM viewEstados";
        $stmt = $pdo->prepare($consulta);

        $stmt->execute();
        return $stmt;
    }
}
