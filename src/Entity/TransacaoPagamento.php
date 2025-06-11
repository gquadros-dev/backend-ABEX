<?php
namespace App\Entity;

use App\Repository\TransacaoPagamentoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransacaoPagamentoRepository::class)]
#[ORM\Table(name: 'public.transacao_pagamento')] // Nome da tabela atualizado
class TransacaoPagamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $tipoPagamento = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, options: ['default' => '0.00'])]
    private ?string $valor = '0.00';

    #[ORM\ManyToOne(targetEntity: Pedido::class, inversedBy: 'transacoesPagamento')]
    #[ORM\JoinColumn(name: 'id_pedido', referencedColumnName: 'id', nullable: true)] // Pode ser null inicialmente
    private ?Pedido $pedido = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoPagamento(): ?string
    {
        return $this->tipoPagamento;
    }

    public function setTipoPagamento(?string $tipoPagamento): static
    {
        $this->tipoPagamento = $tipoPagamento;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): static
    {
        $this->valor = $valor;
        return $this;
    }

    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): static
    {
        $this->pedido = $pedido;
        return $this;
    }
}
