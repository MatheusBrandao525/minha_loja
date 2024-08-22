<?php
class PedidoModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarPedidosDoCliente($clienteId)
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :clienteId";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':clienteId', $clienteId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function buscarDadosPedido($pedidoId, $usuarioId, $ticketPedido)
    {

        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuarioId AND pedido_id = :pedidoId AND ticket_pedido = :ticketPedido";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $stmt->bindParam(':pedidoId', $pedidoId);
            $stmt->bindParam(':ticketPedido', $ticketPedido);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function buscarProdutosPedido($pedidoId, $ticketPedido)
    {
        $sql = "SELECT * FROM produto_pedido WHERE pedido_id = :pedidoId AND ticket_pedido = :ticketPedido";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':pedidoId', $pedidoId);
            $stmt->bindParam(':ticketPedido', $ticketPedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
