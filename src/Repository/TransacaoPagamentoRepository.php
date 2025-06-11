<?php

// src/Repository/TransacaoPagamentoRepository.php
namespace App\Repository;

use App\Entity\TransacaoPagamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TransacaoPagamento>
 *
 * @method TransacaoPagamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransacaoPagamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransacaoPagamento[]    findAll()
 * @method TransacaoPagamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransacaoPagamentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransacaoPagamento::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
