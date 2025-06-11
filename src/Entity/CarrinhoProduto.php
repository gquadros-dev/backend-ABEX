<?php
namespace App\Entity;

use App\Repository\CarrinhoProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarrinhoProdutoRepository::class)]
#[ORM\Table(name: 'public.carrinho_produto')]
class CarrinhoProduto
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: CarrinhoDeCompras::class, inversedBy: 'carrinhoProdutos')]
    #[ORM\JoinColumn(name: 'id_carrinho', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?CarrinhoDeCompras $carrinho = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produto::class, inversedBy: 'carrinhoProdutos')]
    #[ORM\JoinColumn(name: 'id_produto', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Produto $produto = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $quantidade = null;

    public function getCarrinho(): ?CarrinhoDeCompras
    {
        return $this->carrinho;
    }

    public function setCarrinho(?CarrinhoDeCompras $carrinho): static
    {
        $this->carrinho = $carrinho;
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
}
