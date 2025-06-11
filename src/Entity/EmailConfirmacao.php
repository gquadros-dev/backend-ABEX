<?php
namespace App\Entity;

use App\Repository\EmailConfirmacaoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmailConfirmacaoRepository::class)]
#[ORM\Table(name: 'public.email_confirmacao')]
class EmailConfirmacao
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 60)]
    private ?string $destinatario = null;

    #[ORM\Column(type: 'text')]
    private ?string $corpoEmail = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $assuntoEmail = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dataEnvio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestinatario(): ?string
    {
        return $this->destinatario;
    }

    public function setDestinatario(string $destinatario): static
    {
        $this->destinatario = $destinatario;
        return $this;
    }

    public function getCorpoEmail(): ?string
    {
        return $this->corpoEmail;
    }

    public function setCorpoEmail(string $corpoEmail): static
    {
        $this->corpoEmail = $corpoEmail;
        return $this;
    }

    public function getAssuntoEmail(): ?string
    {
        return $this->assuntoEmail;
    }

    public function setAssuntoEmail(string $assuntoEmail): static
    {
        $this->assuntoEmail = $assuntoEmail;
        return $this;
    }

    public function getDataEnvio(): ?\DateTimeInterface
    {
        return $this->dataEnvio;
    }

    public function setDataEnvio(\DateTimeInterface $dataEnvio): static
    {
        $this->dataEnvio = $dataEnvio;
        return $this;
    }
}
