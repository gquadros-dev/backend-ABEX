<?php
// src/Entity/Cliente.php (Atualizada: Adicionada OneToMany para CarrinhoDeCompras e Pedido)
namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
#[ORM\Table(name: 'public.cliente')]
#[ORM\UniqueConstraint(name: "cliente_email_key", columns: ["email"])]
#[ORM\UniqueConstraint(name: "cliente_telefone_key", columns: ["telefone"])]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nome = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $endereco = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $telefone = null;

    #[ORM\Column(type: 'string', length: 9, nullable: true)]
    private ?string $cep = null;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: CarrinhoDeCompras::class, orphanRemoval: true)]
    private Collection $carrinhosDeCompras;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Pedido::class, orphanRemoval: true)]
    private Collection $pedidos;

    public function __construct()
    {
        $this->carrinhosDeCompras = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): static
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): static
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): static
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return Collection<int, CarrinhoDeCompras>
     */
    public function getCarrinhosDeCompras(): Collection
    {
        return $this->carrinhosDeCompras;
    }

    public function addCarrinhosDeCompra(CarrinhoDeCompras $carrinhosDeCompra): static
    {
        if (!$this->carrinhosDeCompras->contains($carrinhosDeCompra)) {
            $this->carrinhosDeCompras->add($carrinhosDeCompra);
            $carrinhosDeCompra->setCliente($this);
        }
        return $this;
    }

    public function removeCarrinhosDeCompra(CarrinhoDeCompras $carrinhosDeCompra): static
    {
        if ($this->carrinhosDeCompras->removeElement($carrinhosDeCompra)) {
            // set the owning side to null (unless already changed)
            if ($carrinhosDeCompra->getCliente() === $this) {
                $carrinhosDeCompra->setCliente(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Pedido>
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): static
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos->add($pedido);
            $pedido->setCliente($this);
        }
        return $this;
    }

    public function removePedido(Pedido $pedido): static
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getCliente() === $this) {
                $pedido->setCliente(null);
            }
        }
        return $this;
    }
}
