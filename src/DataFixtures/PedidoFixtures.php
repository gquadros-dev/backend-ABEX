<?php

namespace App\DataFixtures;

use App\Entity\Pedido;
use App\Entity\Cliente; // Assumindo que você tem clientes
use App\Entity\Produto; // Assumindo que você tem produtos
use App\Entity\PedidoProduto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface; // Importar esta interface

class PedidoFixtures extends Fixture implements DependentFixtureInterface // Adicionar a implementação da interface
{
    /**
     * Carrega dados de clientes de exemplo no banco de dados.
     *
     * @param ObjectManager $manager O gerenciador de objetos do Doctrine para persistir dados.
     */
    public function load(ObjectManager $manager): void
    {
        $cliente = $manager->getRepository(Cliente::class)->findOneBy([]); // Pega um cliente qualquer
        $produtos = $manager->getRepository(Produto::class)->findAll(); // Pega todos os produtos

        if (!$cliente || count($produtos) < 2) {
            // Se não houver clientes ou produtos suficientes, não há como criar pedidos.
            // Idealmente, você pode adicionar um log ou mensagem aqui para depuração.
            error_log("Não foi possível carregar PedidoFixtures: Clientes ou Produtos insuficientes.");
            return;
        }

        // Pedido de 5 dias atrás com 2 produtos
        $pedido1 = new Pedido();
        $pedido1->setCliente($cliente);
        $pedido1->setDataPedido(new \DateTimeImmutable('-5 days'));
        $pedido1->setStatus('Aprovado');
        $pedido1->setValorTotal('180.00'); // Valor fictício
        $pedido1->setEnderecoEnvio($cliente->getEndereco());
        $manager->persist($pedido1);

        $pedidoProduto1 = new PedidoProduto();
        $pedidoProduto1->setPedido($pedido1);
        $pedidoProduto1->setProduto($produtos[0]);
        $pedidoProduto1->setQuantidade(2);
        $pedidoProduto1->setPrecoUnitario($produtos[0]->getPreco());
        $manager->persist($pedidoProduto1);

        $pedidoProduto2 = new PedidoProduto();
        $pedidoProduto2->setPedido($pedido1);
        $pedidoProduto2->setProduto($produtos[1]);
        $pedidoProduto2->setQuantidade(1);
        $pedidoProduto2->setPrecoUnitario($produtos[1]->getPreco());
        $manager->persist($pedidoProduto2);

        // Outro pedido de 3 dias atrás
        $pedido2 = new Pedido();
        $pedido2->setCliente($cliente);
        $pedido2->setDataPedido(new \DateTimeImmutable('-3 days'));
        $pedido2->setStatus('Aprovado');
        $pedido2->setValorTotal('300.00');
        $pedido2->setEnderecoEnvio($cliente->getEndereco());
        $manager->persist($pedido2);

        $pedidoProduto3 = new PedidoProduto();
        $pedidoProduto3->setPedido($pedido2);
        $pedidoProduto3->setProduto($produtos[0]); // Mesmo produto 1
        $pedidoProduto3->setQuantidade(1);
        $pedidoProduto3->setPrecoUnitario($produtos[0]->getPreco());
        $manager->persist($pedidoProduto3);

        $manager->flush();
    }

    /**
     * Define as dependências desta fixture.
     * As classes listadas aqui serão carregadas ANTES desta fixture.
     */
    public function getDependencies(): array
    {
        return [
            ClienteFixtures::class, // Garante que clientes sejam carregados antes
            ProdutoFixtures::class, // Garante que produtos sejam carregados antes
        ];
    }
}
