<?php
namespace App\Entity;

use App\Repository\FavoritoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoritoRepository::class)]
#[ORM\Table(name: 'public.favoritos')]
class Favorito
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @ORM\Column(type: 'string', length: 100)
     *
     * ATENÇÃO: Armazenar múltiplos produtos como uma string (CSV, JSON, etc.)
     * não é uma boa prática em bancos de dados relacionais.
     * O ideal seria ter uma tabela de junção (Ex: favoritos_produto)
     * para modelar um relacionamento muitos-para-muitos entre Favorito e Produto,
     * e uma relação de um-para-um (ou um-para-muitos) entre Cliente e Favorito.
     * Exemplo de modelagem mais robusta:
     *
     * class Favorito {
     * #[ORM\Id]
     * #[ORM\GeneratedValue]
     * #[ORM\Column(type: 'integer')]
     * private ?int $id = null;
     *
     * #[ORM\OneToOne(targetEntity: Cliente::class, inversedBy: 'favorito')]
     * #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id', nullable: false)]
     * private ?Cliente $cliente = null;
     *
     * #[ORM\ManyToMany(targetEntity: Produto::class)]
     * #[ORM\JoinTable(name: 'favoritos_produto')]
     * #[ORM\JoinColumn(name: 'favorito_id', referencedColumnName: 'id')]
     * #[ORM\InverseJoinColumn(name: 'produto_id', referencedColumnName: 'id')]
     * private Collection $produtos;
     *
     * public function __construct() {
     * $this->produtos = new ArrayCollection();
     * }
     * // ... getters/setters
     * }
     */
    #[ORM\Column(type: 'string', length: 100)]
    private ?string $produtos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdutos(): ?string
    {
        return $this->produtos;
    }

    public function setProdutos(string $produtos): static
    {
        $this->produtos = $produtos;
        return $this;
    }
}
