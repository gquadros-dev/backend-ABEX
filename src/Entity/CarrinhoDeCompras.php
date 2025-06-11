<?php

// src/Entity/CarrinhoDeCompras.php (Atualizada: Adicionada FK para Cliente)
namespace App\Entity;

use App\Repository\CarrinhoDeComprasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarrinhoDeComprasRepository::class)]
#[ORM\Table(name: 'public.carrinho_de_compras')]
class CarrinhoDeCompras
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 9)]
    private ?string $cep = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $frete = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, options: ['default' => '0.00'])]
    private ?string $total = '0.00';

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'carrinhosDeCompras')]
    #[ORM\JoinColumn(name: 'id_cliente', referencedColumnName: 'id', nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\OneToMany(mappedBy: 'carrinho', targetEntity: CarrinhoProduto::class, orphanRemoval: true)]
    private Collection $carrinhoProdutos;

    public function __construct()
    {
        $this->carrinhoProdutos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(string $cep): static
    {
        $this->cep = $cep;
        return $this;
    }

    public function getFrete(): ?string
    {
        return $this->frete;
    }

    public function setFrete(?string $frete): static
    {
        $this->frete = $frete;
        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;
        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;
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
            $carrinhoProduto->setCarrinho($this);
        }
        return $this;
    }

    public function removeCarrinhoProduto(CarrinhoProduto $carrinhoProduto): static
    {
        if ($this->carrinhoProdutos->removeElement($carrinhoProduto)) {
            // set the owning side to null (unless already changed)
            if ($carrinhoProduto->getCarrinho() === $this) {
                $carrinhoProduto->setCarrinho(null);
            }
        }
        return $this;
    }
}
