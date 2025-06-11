<?php

// src/Repository/CarrinhoProdutoRepository.php
namespace App\Repository;

use App\Entity\CarrinhoProduto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarrinhoProduto>
 *
 * @method CarrinhoProduto|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarrinhoProduto|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarrinhoProduto[]    findAll()
 * @method CarrinhoProduto[]    findBy(array array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrinhoProdutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarrinhoProduto::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
