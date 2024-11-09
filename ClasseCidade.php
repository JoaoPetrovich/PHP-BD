<?php
class ClasseCidade
{
    private $idCidade;
    private $nome;
    private $idEstado;
    private $clientes;

    public function getIdCidade()
    {
        return $this->idCidade;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getIdEstado()
    {
        return $this->idEstado;
    }
    public function getClientes()
    {
        return $this->clientes;
    }
    public function setIdCidade($idCidade)
    {
        $this->idCidade = $idCidade;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }
    public function setClientes($clientes)
    {
        $this->clientes = $clientes;
    }

    /* Método inserirCidade */
    public function inserirCidade($nome, $idEstado)
    {
        require("conexaobd.php");
        $comando = "SELECT inserirCidade(:nome,:idEstado) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":idEstado", $idEstado);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método alterarCidade */
    public function alterarCidade($idEstado, $idCidade, $nome)
    {
        require("conexaobd.php");
        $comando = "SELECT alterarCidade(:idCidade,:nome,:idEstado) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idCidade", $idCidade);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":idEstado", $idEstado);
        $stmt->execute();

        $resultado = null;

        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método excluirCidade */
    public function excluirCidade($idCidade)
    {
        require("conexaobd.php");
        $comando = "SELECT excluirCidade(:idCidade) AS Resultado;";
        $stmt = $pdo->prepare($comando);
        $stmt->bindParam(":idCidade", $idCidade);
        $stmt->execute();
        $resultado = null;
        foreach ($stmt as $linha) {
            $resultado = $linha["Resultado"];
        }
        return $resultado;
    }

    /* Método consultarCidades */
    public function consultarCidades($idCidade)
    {
        require("conexaobd.php");
        $consulta = "SELECT * FROM viewCidades WHERE IDCIDADE=:idCidade";
        $stmt = $pdo->prepare($consulta);
        $stmt->bindParam(":idCidade", $idCidade);
        $stmt->execute();
        foreach ($stmt as $linha) {
            $this->idCidade = $linha["idCidade"];
            $this->nome = $linha["nomeCidade"];
            $this->idEstado = $linha["idEstado"];
            $this->clientes = $linha["clientesCidade"];
        }
    }

    /* Método listarCidades*/
    public function listarCidades()
    {
        require("conexaobd.php");
        $consulta = "SELECT * FROM viewCidades";
        $stmt = $pdo->prepare($consulta);

        $stmt->execute();
        return $stmt;
    }
}
