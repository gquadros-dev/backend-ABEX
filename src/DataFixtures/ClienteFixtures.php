<?php

// src/DataFixtures/ClienteFixtures.php
namespace App\DataFixtures;

use App\Entity\Cliente; // Importa a entidade Cliente
use Doctrine\Bundle\FixturesBundle\Fixture; // Classe base para fixtures
use Doctrine\Persistence\ObjectManager; // Gerenciador de objetos do Doctrine

class ClienteFixtures extends Fixture
{
    /**
     * Carrega dados de clientes de exemplo no banco de dados.
     *
     * @param ObjectManager $manager O gerenciador de objetos do Doctrine para persistir dados.
     */
    public function load(ObjectManager $manager): void
    {
        // Array de dados de clientes de exemplo
        $clientesData = [
            [
                'nome' => 'Ana Paula Silva',
                'email' => 'ana.paula@example.com',
                'endereco' => 'Rua das Flores, 123, Centro',
                'telefone' => '11987654321',
                'cep' => '01000-001'
            ],
            [
                'nome' => 'Carlos Eduardo Lima',
                'email' => 'carlos.lima@example.com',
                'endereco' => 'Avenida Principal, 456, Bela Vista',
                'telefone' => '21987654322',
                'cep' => '20000-002'
            ],
            [
                'nome' => 'Mariana Souza Santos',
                'email' => 'mariana.santos@example.com',
                'endereco' => 'Praça da Liberdade, 78, Jardim América',
                'telefone' => '31987654323',
                'cep' => '30000-003'
            ],
            [
                'nome' => 'João Victor Costa',
                'email' => 'joao.costa@example.com',
                'endereco' => 'Travessa da Paz, 9, Alto da Serra',
                'telefone' => '41987654324',
                'cep' => '80000-004'
            ],
            [
                'nome' => 'Fernanda Oliveira Rocha',
                'email' => 'fernanda.rocha@example.com',
                'endereco' => 'Alameda dos Ipês, 101, Laranjeiras',
                'telefone' => '51987654325',
                'cep' => '90000-005'
            ],
            [
                'nome' => 'Gustavo Almeida Dias',
                'email' => 'gustavo.dias@example.com',
                'endereco' => 'Estrada Velha, 202, Morro Azul',
                'telefone' => '61987654326',
                'cep' => '70000-006'
            ],
            [
                'nome' => 'Patrícia Nogueira Barros',
                'email' => 'patricia.barros@example.com',
                'endereco' => 'Rua Nova, 303, Santa Cruz',
                'telefone' => '71987654327',
                'cep' => '40000-007'
            ],
            [
                'nome' => 'Roberto Mendes Fernandes',
                'email' => 'roberto.fernandes@example.com',
                'endereco' => 'Avenida do Sol, 404, Rio Branco',
                'telefone' => '81987654328',
                'cep' => '50000-008'
            ],
            [
                'nome' => 'Luiza Martins Cavalcanti',
                'email' => 'luiza.cavalcanti@example.com',
                'endereco' => 'Rua da Amizade, 505, Boa Viagem',
                'telefone' => '91987654329',
                'cep' => '60000-009'
            ],
            [
                'nome' => 'Daniel Goulart Pires',
                'email' => 'daniel.pires@example.com',
                'endereco' => 'Praça da Matriz, 606, Centro Histórico',
                'telefone' => '11987654330',
                'cep' => '01000-010'
            ],
        ];

        foreach ($clientesData as $data) {
            $cliente = new Cliente();
            $cliente->setNome($data['nome']);
            $cliente->setEmail($data['email']);
            $cliente->setEndereco($data['endereco']);
            $cliente->setTelefone($data['telefone']);
            $cliente->setCep($data['cep']);

            $manager->persist($cliente); // Prepara a entidade para ser salva
        }

        $manager->flush(); // Salva todas as entidades preparadas no banco de dados
    }
}
