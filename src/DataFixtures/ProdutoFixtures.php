<?php

// src/DataFixtures/ProdutoFixtures.php
namespace App\DataFixtures;

use App\Entity\Produto; // Importa a entidade Produto
use Doctrine\Bundle\FixturesBundle\Fixture; // Classe base para fixtures
use Doctrine\Persistence\ObjectManager; // Gerenciador de objetos do Doctrine

class ProdutoFixtures extends Fixture
{
    /**
     * Carrega dados de produtos de exemplo (focados em roupas) no banco de dados.
     *
     * @param ObjectManager $manager O gerenciador de objetos do Doctrine para persistir dados.
     */
    public function load(ObjectManager $manager): void
    {
        // Array de dados de produtos de exemplo focados em roupas
        $produtosData = [
            [
                'nome' => 'Camiseta Básica Algodão',
                'descricao' => 'Camiseta 100% algodão, macia e confortável, ideal para o dia a dia.',
                'preco' => 59.90,
                'categoria' => 'Camisetas',
                'disponibilidade' => 'disponivel',
                'estoque' => 500,
                'foto_path' => 'https://placehold.co/600x400/FF5733/FFFFFF?text=Camiseta+Básica'
            ],
            [
                'nome' => 'Calça Jeans Skinny Masculina',
                'descricao' => 'Jeans com elastano, corte ajustado e lavagem moderna.',
                'preco' => 189.99,
                'categoria' => 'Calças',
                'disponibilidade' => 'disponivel',
                'estoque' => 250,
                'foto_path' => 'https://placehold.co/600x400/3366FF/FFFFFF?text=Jeans+Skinny'
            ],
            [
                'nome' => 'Vestido Floral Verão',
                'descricao' => 'Vestido leve com estampa floral, perfeito para dias quentes.',
                'preco' => 129.50,
                'categoria' => 'Vestidos',
                'disponibilidade' => 'disponivel',
                'estoque' => 180,
                'foto_path' => 'https://placehold.co/600x400/FF33CC/FFFFFF?text=Vestido+Floral'
            ],
            [
                'nome' => 'Jaqueta Corta-Vento Esportiva',
                'descricao' => 'Proteção contra o vento e chuva leve, ideal para atividades ao ar livre.',
                'preco' => 249.00,
                'categoria' => 'Casacos',
                'disponibilidade' => 'disponivel',
                'estoque' => 100,
                'foto_path' => 'https://placehold.co/600x400/999999/FFFFFF?text=Corta+Vento'
            ],
            [
                'nome' => 'Blusa de Lã Gola Alta Feminina',
                'descricao' => 'Blusa de lã macia e quente, essencial para o inverno.',
                'preco' => 150.00,
                'categoria' => 'Blusas',
                'disponibilidade' => 'disponivel',
                'estoque' => 120,
                'foto_path' => 'https://placehold.co/600x400/800080/FFFFFF?text=Blusa+Lã'
            ],
            [
                'nome' => 'Bermuda Sarja Masculina',
                'descricao' => 'Bermuda de sarja confortável, perfeita para o verão.',
                'preco' => 89.90,
                'categoria' => 'Bermudas',
                'disponibilidade' => 'disponivel',
                'estoque' => 200,
                'foto_path' => 'https://placehold.co/600x400/008000/FFFFFF?text=Bermuda+Sarja'
            ],
            [
                'nome' => 'Saia Plissada Midi',
                'descricao' => 'Saia elegante com caimento leve e plissado delicado.',
                'preco' => 110.00,
                'categoria' => 'Saias',
                'disponibilidade' => 'disponivel',
                'estoque' => 90,
                'foto_path' => 'https://placehold.co/600x400/FFD700/000000?text=Saia+Plissada'
            ],
            [
                'nome' => 'Moletom Canguru Unissex',
                'descricao' => 'Moletom flanelado com capuz e bolso canguru, muito confortável.',
                'preco' => 170.00,
                'categoria' => 'Moletons',
                'disponibilidade' => 'disponivel',
                'estoque' => 130,
                'foto_path' => 'https://placehold.co/600x400/4B0082/FFFFFF?text=Moletom'
            ],
            [
                'nome' => 'Meias Cano Longo Esportivas (3 Pares)',
                'descricao' => 'Meias respiráveis e macias, ideais para prática de esportes.',
                'preco' => 35.00,
                'categoria' => 'Acessórios',
                'disponibilidade' => 'disponivel',
                'estoque' => 300,
                'foto_path' => 'https://placehold.co/600x400/C0C0C0/000000?text=Meias'
            ],
            [
                'nome' => 'Pijama Longo Inverno Feminino',
                'descricao' => 'Pijama confortável de flanela, ideal para noites frias.',
                'preco' => 95.00,
                'categoria' => 'Pijamas',
                'disponibilidade' => 'disponivel',
                'estoque' => 70,
                'foto_path' => 'https://placehold.co/600x400/FFC0CB/000000?text=Pijama+Feminino'
            ],
            [
                'nome' => 'Camisa Social Slim Fit',
                'descricao' => 'Camisa social de algodão com corte slim, elegante e moderna.',
                'preco' => 199.90,
                'categoria' => 'Camisas',
                'disponibilidade' => 'disponivel',
                'estoque' => 80,
                'foto_path' => 'https://placehold.co/600x400/1E90FF/FFFFFF?text=Camisa+Social'
            ],
            [
                'nome' => 'Regata Esportiva Masculina',
                'descricao' => 'Regata em tecido respirável, ideal para treinos.',
                'preco' => 45.00,
                'categoria' => 'Camisetas',
                'disponibilidade' => 'disponivel',
                'estoque' => 220,
                'foto_path' => 'https://placehold.co/600x400/40E0D0/FFFFFF?text=Regata+Esportiva'
            ],
            [
                'nome' => 'Shorts Jeans Feminino',
                'descricao' => 'Shorts jeans com desfiado na barra, casual e estiloso.',
                'preco' => 79.90,
                'categoria' => 'Shorts',
                'disponibilidade' => 'disponivel',
                'estoque' => 150,
                'foto_path' => 'https://placehold.co/600x400/DAA520/FFFFFF?text=Shorts+Jeans'
            ],
            [
                'nome' => 'Macacão Pantacourt Viscose',
                'descricao' => 'Macacão leve e fluído, perfeito para um look casual chic.',
                'preco' => 160.00,
                'categoria' => 'Macacões',
                'disponibilidade' => 'disponivel',
                'estoque' => 60,
                'foto_path' => 'https://placehold.co/600x400/F08080/FFFFFF?text=Macacão+Pantacourt'
            ],
            [
                'nome' => 'Cinto de Couro Genuíno',
                'descricao' => 'Cinto clássico de couro legítimo, durável e versátil.',
                'preco' => 99.00,
                'categoria' => 'Acessórios',
                'disponibilidade' => 'disponivel',
                'estoque' => 100,
                'foto_path' => 'https://placehold.co/600x400/8B4513/FFFFFF?text=Cinto+Couro'
            ],
            [
                'nome' => 'Conjunto de Lingerie Renda',
                'descricao' => 'Conjunto delicado e sensual em renda de alta qualidade.',
                'preco' => 140.00,
                'categoria' => 'Lingerie',
                'disponibilidade' => 'disponivel',
                'estoque' => 75,
                'foto_path' => 'https://placehold.co/600x400/DDA0DD/000000?text=Lingerie+Renda'
            ],
            [
                'nome' => 'Cardigã Tricot Oversized',
                'descricao' => 'Cardigã em tricot macio, com caimento oversized, ideal para sobreposições.',
                'preco' => 190.00,
                'categoria' => 'Blusas',
                'disponibilidade' => 'disponivel',
                'estoque' => 65,
                'foto_path' => 'https://placehold.co/600x400/6A5ACD/FFFFFF?text=Cardigã+Tricot'
            ],
            [
                'nome' => 'Cueca Boxer Microfibra (3 Peças)',
                'descricao' => 'Kit de cuecas boxer em microfibra, conforto e ajuste perfeito.',
                'preco' => 65.00,
                'categoria' => 'Roupa Íntima',
                'disponibilidade' => 'disponivel',
                'estoque' => 200,
                'foto_path' => 'https://placehold.co/600x400/4682B4/FFFFFF?text=Cueca+Boxer'
            ],
            [
                'nome' => 'Chapéu de Sol Aba Larga',
                'descricao' => 'Proteção elegante contra o sol, ideal para praia ou piscina.',
                'preco' => 50.00,
                'categoria' => 'Acessórios',
                'disponibilidade' => 'disponivel',
                'estoque' => 90,
                'foto_path' => 'https://placehold.co/600x400/F4A460/000000?text=Chapéu+Sol'
            ],
            [
                'nome' => 'Body Manga Longa Canelado',
                'descricao' => 'Body canelado com manga longa, versátil e confortável.',
                'preco' => 85.00,
                'categoria' => 'Bodys',
                'disponibilidade' => 'disponivel',
                'estoque' => 110,
                'foto_path' => 'https://placehold.co/600x400/D8BFD8/000000?text=Body+Canelado'
            ],
        ];

        foreach ($produtosData as $data) {
            $produto = new Produto();
            $produto->setNome($data['nome']);
            $produto->setDescricao($data['descricao']);
            $produto->setPreco((string) $data['preco']); // Preço como string para numeric
            $produto->setCategoria($data['categoria']);
            $produto->setDisponibilidade($data['disponibilidade']);
            $produto->setEstoque($data['estoque']);
            $produto->setFotoPath($data['foto_path']);

            $manager->persist($produto); // Prepara a entidade para ser salva
        }

        $manager->flush(); // Salva todas as entidades preparadas no banco de dados
    }
}
