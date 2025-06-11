<?php
namespace App\Entity;

use App\Repository\CatalogoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatalogoRepository::class)]
#[ORM\Table(name: 'public.catalogo')]
class Catalogo
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dataAtualizacao = null;

    #[ORM\OneToMany(mappedBy: 'catalogo', targetEntity: CatalogoProduto::class, orphanRemoval: true)]
    private Collection $catalogoProdutos;

    public function __construct()
    {
        $this->catalogoProdutos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataAtualizacao(): ?\DateTimeInterface
    {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao(\DateTimeInterface $dataAtualizacao): static
    {
        $this->dataAtualizacao = $dataAtualizacao;
        return $this;
    }

    /**
     * @return Collection<int, CatalogoProduto>
     */
    public function getCatalogoProdutos(): Collection
    {
        return $this->catalogoProdutos;
    }

    public function addCatalogoProduto(CatalogoProduto $catalogoProduto): static
    {
        if (!$this->catalogoProdutos->contains($catalogoProduto)) {
            $this->catalogoProdutos->add($catalogoProduto);
            $catalogoProduto->setCatalogo($this);
        }
        return $this;
    }

    public function removeCatalogoProduto(CatalogoProduto $catalogoProduto): static
    {
        if ($this->catalogoProdutos->removeElement($catalogoProduto)) {
            // set the owning side to null (unless already changed)
            if ($catalogoProduto->getCatalogo() === $this) {
                $catalogoProduto->setCatalogo(null);
            }
        }
        return $this;
    }
}
