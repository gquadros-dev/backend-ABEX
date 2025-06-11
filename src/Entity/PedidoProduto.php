<?php
// src/Entity/PedidoProduto.php (NOVA ENTIDADE - Tabela de junção para Pedido x Produto)
namespace App\Entity;

use App\Repository\PedidoProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoProdutoRepository::class)]
#[ORM\Table(name: 'public.pedido_produto')]
class PedidoProduto
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Pedido::class, inversedBy: 'pedidoProdutos')]
    #[ORM\JoinColumn(name: 'id_pedido', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Pedido $pedido = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produto::class, inversedBy: 'pedidoProdutos')]
    #[ORM\JoinColumn(name: 'id_produto', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Produto $produto = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $quantidade = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $precoUnitario = null; // Preço do produto no momento do pedido

    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): static
    {
        $this->pedido = $pedido;
        return $this;
    }

    public function getProduto(): ?Produto
    {
        return $this->produto;
    }

    public function setProduto(?Produto $produto): static
    {
        $this->produto = $produto;
        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): static
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getPrecoUnitario(): ?string
    {
        return $this->precoUnitario;
    }

    public function setPrecoUnitario(string $precoUnitario): static
    {
        $this->precoUnitario = $precoUnitario;
        return $this;
    }
}
