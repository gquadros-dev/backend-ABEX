<?php

// src/Repository/FavoritoRepository.php
namespace App\Repository;

use App\Entity\Favorito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favorito>
 *
 * @method Favorito|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorito|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorito[]    findAll()
 * @method Favorito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorito::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
