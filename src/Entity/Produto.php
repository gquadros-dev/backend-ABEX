<?php

// src/Entity/Produto.php
namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; // Importar a anotação Groups

#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
#[ORM\Table(name: 'public.produtos')]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    #[Groups(['produto:read'])] // Adicionado
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $fotoPath = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $nome = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $descricao = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $preco = null;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $categoria = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(['produto:read'])] // Adicionado
    private ?string $disponibilidade = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['produto:read'])] // Adicionado
    private ?int $estoque = null;

    // As coleções de relacionamentos geralmente não são serializadas diretamente
    // a menos que você queira aninhar esses dados na resposta JSON.
    // Para evitar ciclos infinitos e excesso de dados, é comum não serializá-las aqui.
    #[ORM\OneToMany(mappedBy: 'produto', targetEntity: CarrinhoProduto::class, orphanRemoval: true)]
    private Collection $carrinhoProdutos;

    #[ORM\OneToMany(mappedBy: 'produto', targetEntity: CatalogoProduto::class, orphanRemoval: true)]
    private Collection $catalogoProdutos;

    #[ORM\OneToMany(mappedBy: 'produto', targetEntity: PedidoProduto::class, orphanRemoval: true)]
    private Collection $pedidoProdutos;

    public function __construct()
    {
        $this->carrinhoProdutos = new ArrayCollection();
        $this->catalogoProdutos = new ArrayCollection();
        $this->pedidoProdutos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFotoPath(): ?string
    {
        return $this->fotoPath;
    }

    public function setFotoPath(?string $fotoPath): static
    {
        $this->fotoPath = $fotoPath;
        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;
        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getPreco(): ?string
    {
        return $this->preco;
    }

    public function setPreco(string $preco): static
    {
        $this->preco = $preco;
        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(?string $categoria): static
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function getDisponibilidade(): ?string
    {
        return $this->disponibilidade;
    }

    public function setDisponibilidade(string $disponibilidade): static
    {
        $this->disponibilidade = $disponibilidade;
        return $this;
    }

    public function getEstoque(): ?int
    {
        return $this->estoque;
    }

    public function setEstoque(?int $estoque): static
    {
        if ($estoque !== null && $estoque < 0) {
            throw new \InvalidArgumentException("Estoque não pode ser negativo.");
        }
        $this->estoque = $estoque;
        return $this;
    }

    /**
     * @return Collection<int, CarrinhoProduto>
     */
    public function getCarrinhoProdutos(): Collection
    {
        return $this->carrinhoProdutos;
    }

    public function addCarrinhoProduto(CarrinhoProduto $carrinhoProduto): static
    {
        if (!$this->carrinhoProdutos->contains($carrinhoProduto)) {
            $this->carrinhoProdutos->add($carrinhoProduto);
            $carrinhoProduto->setProduto($this);
        }
        return $this;
    }

    public function removeCarrinhoProduto(CarrinhoProduto $carrinhoProduto): static
    {
        if ($this->carrinhoProdutos->removeElement($carrinhoProduto)) {
            if ($carrinhoProduto->getProduto() === $this) {
                $carrinhoProduto->setProduto(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, CatalogoProduto>
     */
    public function getCatalogoProdutos(): Collection
    {
        return $this->catalogoProdutos;
    }

    public function addCatalogoProduto(CatalogoProduto $catalogoProduto): static
    {
        if (!$this->catalogoProdutos->contains($catalogoProduto)) {
            $this->catalogoProdutos->add($catalogoProduto);
            $catalogoProduto->setProduto($this);
        }
        return $this;
    }

    public function removeCatalogoProduto(CatalogoProduto $catalogoProduto): static
    {
        if ($this->catalogoProdutos->removeElement($catalogoProduto)) {
            if ($catalogoProduto->getProduto() === $this) {
                $catalogoProduto->setProduto(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, PedidoProduto>
     */
    public function getPedidoProdutos(): Collection
    {
        return $this->pedidoProdutos;
    }

    public function addPedidoProduto(PedidoProduto $pedidoProduto): static
    {
        if (!$this->pedidoProdutos->contains($pedidoProduto)) {
            $this->pedidoProdutos->add($pedidoProduto);
            $pedidoProduto->setProduto($this);
        }
        return $this;
    }

    public function removePedidoProduto(PedidoProduto $pedidoProduto): static
    {
        if ($this->pedidoProdutos->removeElement($pedidoProduto)) {
            if ($pedidoProduto->getProduto() === $this) {
                $pedidoProduto->setProduto(null);
            }
        }
        return $this;
    }
}
