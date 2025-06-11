<?php

// src/Repository/CarrinhoDeComprasRepository.php
namespace App\Repository;

use App\Entity\CarrinhoDeCompras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarrinhoDeCompras>
 *
 * @method CarrinhoDeCompras|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarrinhoDeCompras|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarrinhoDeCompras[]    findAll()
 * @method CarrinhoDeCompras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrinhoDeComprasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarrinhoDeCompras::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
