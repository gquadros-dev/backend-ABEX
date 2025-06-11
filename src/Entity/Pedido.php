<?php
// src/Entity/Pedido.php (NOVA ENTIDADE)
namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
#[ORM\Table(name: 'public.pedido')]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'pedidos')]
    #[ORM\JoinColumn(name: 'id_cliente', referencedColumnName: 'id', nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\OneToOne(targetEntity: CarrinhoDeCompras::class)]
    #[ORM\JoinColumn(name: 'id_carrinho_de_compras', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')] // SET NULL para preservar o carrinho original
    private ?CarrinhoDeCompras $carrinhoDeCompras = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dataPedido = null;

    #[ORM\Column(type: 'string', length: 50)] // Ex: 'Pendente', 'Aprovado', 'Processando', 'Enviado', 'Entregue', 'Cancelado'
    private ?string $status = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $valorTotal = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)] // Endereço completo ou FK para Endereco se criar
    private ?string $enderecoEnvio = null;

    #[ORM\OneToMany(mappedBy: 'pedido', targetEntity: TransacaoPagamento::class, orphanRemoval: true)]
    private Collection $transacoesPagamento;

    #[ORM\OneToMany(mappedBy: 'pedido', targetEntity: PedidoProduto::class, orphanRemoval: true)]
    private Collection $pedidoProdutos;

    public function __construct()
    {
        $this->transacoesPagamento = new ArrayCollection();
        $this->pedidoProdutos = new ArrayCollection();
        $this->dataPedido = new \DateTimeImmutable(); // Define a data do pedido na criação
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCarrinhoDeCompras(): ?CarrinhoDeCompras
    {
        return $this->carrinhoDeCompras;
    }

    public function setCarrinhoDeCompras(?CarrinhoDeCompras $carrinhoDeCompras): static
    {
        $this->carrinhoDeCompras = $carrinhoDeCompras;
        return $this;
    }

    public function getDataPedido(): ?\DateTimeInterface
    {
        return $this->dataPedido;
    }

    public function setDataPedido(\DateTimeInterface $dataPedido): static
    {
        $this->dataPedido = $dataPedido;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getValorTotal(): ?string
    {
        return $this->valorTotal;
    }

    public function setValorTotal(string $valorTotal): static
    {
        $this->valorTotal = $valorTotal;
        return $this;
    }

    public function getEnderecoEnvio(): ?string
    {
        return $this->enderecoEnvio;
    }

    public function setEnderecoEnvio(?string $enderecoEnvio): static
    {
        $this->enderecoEnvio = $enderecoEnvio;
        return $this;
    }

    /**
     * @return Collection<int, TransacaoPagamento>
     */
    public function getTransacoesPagamento(): Collection
    {
        return $this->transacoesPagamento;
    }

    public function addTransacoesPagamento(TransacaoPagamento $transacoesPagamento): static
    {
        if (!$this->transacoesPagamento->contains($transacoesPagamento)) {
            $this->transacoesPagamento->add($transacoesPagamento);
            $transacoesPagamento->setPedido($this);
        }
        return $this;
    }

    public function removeTransacoesPagamento(TransacaoPagamento $transacoesPagamento): static
    {
        if ($this->transacoesPagamento->removeElement($transacoesPagamento)) {
            // set the owning side to null (unless already changed)
            if ($transacoesPagamento->getPedido() === $this) {
                $transacoesPagamento->setPedido(null);
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
            $pedidoProduto->setPedido($this);
        }
        return $this;
    }

    public function removePedidoProduto(PedidoProduto $pedidoProduto): static
    {
        if ($this->pedidoProdutos->removeElement($pedidoProduto)) {
            // set the owning side to null (unless already changed)
            if ($pedidoProduto->getPedido() === $this) {
                $pedidoProduto->setPedido(null);
            }
        }
        return $this;
    }
}
