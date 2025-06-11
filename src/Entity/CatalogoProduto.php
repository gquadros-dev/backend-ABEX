<?php
// src/Entity/CatalogoProduto.php (Removida UniqueConstraint duplicada)
namespace App\Entity;

use App\Repository\CatalogoProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatalogoProdutoRepository::class)]
#[ORM\Table(name: 'public.catalogo_produto')]
class CatalogoProduto
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Catalogo::class, inversedBy: 'catalogoProdutos')]
    #[ORM\JoinColumn(name: 'id_catalogo', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Catalogo $catalogo = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produto::class, inversedBy: 'catalogoProdutos')]
    #[ORM\JoinColumn(name: 'id_produto', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Produto $produto = null;

    public function getCatalogo(): ?Catalogo
    {
        return $this->catalogo;
    }

    public function setCatalogo(?Catalogo $catalogo): static
    {
        $this->catalogo = $catalogo;
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
}
