<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611170913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE public.administrador (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX administrador_email_key ON public.administrador (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX administrador_telefone_key ON public.administrador (telefone)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.carrinho_de_compras (id SERIAL NOT NULL, id_cliente INT NOT NULL, cep VARCHAR(9) NOT NULL, frete NUMERIC(10, 2) DEFAULT NULL, total NUMERIC(10, 2) DEFAULT '0.00' NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E59669FC2A813255 ON public.carrinho_de_compras (id_cliente)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.carrinho_produto (id_carrinho INT NOT NULL, id_produto INT NOT NULL, quantidade INT NOT NULL, PRIMARY KEY(id_carrinho, id_produto))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F91848F4F7EA0F55 ON public.carrinho_produto (id_carrinho)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F91848F48231E0A7 ON public.carrinho_produto (id_produto)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.catalogo (id SERIAL NOT NULL, data_atualizacao DATE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.catalogo_produto (id_catalogo INT NOT NULL, id_produto INT NOT NULL, PRIMARY KEY(id_catalogo, id_produto))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A0313A0BB77787D0 ON public.catalogo_produto (id_catalogo)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A0313A0B8231E0A7 ON public.catalogo_produto (id_produto)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.cliente (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, endereco VARCHAR(255) DEFAULT NULL, telefone VARCHAR(20) DEFAULT NULL, cep VARCHAR(9) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX cliente_email_key ON public.cliente (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX cliente_telefone_key ON public.cliente (telefone)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.email_confirmacao (id SERIAL NOT NULL, destinatario VARCHAR(60) NOT NULL, corpo_email TEXT NOT NULL, assunto_email VARCHAR(100) NOT NULL, data_envio TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.favoritos (id SERIAL NOT NULL, produtos VARCHAR(100) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.pedido (id SERIAL NOT NULL, id_cliente INT NOT NULL, id_carrinho_de_compras INT DEFAULT NULL, data_pedido TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(50) NOT NULL, valor_total NUMERIC(10, 2) NOT NULL, endereco_envio VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E0262EE2A813255 ON public.pedido (id_cliente)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8E0262EECB951B81 ON public.pedido (id_carrinho_de_compras)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.pedido_produto (id_pedido INT NOT NULL, id_produto INT NOT NULL, quantidade INT NOT NULL, preco_unitario NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id_pedido, id_produto))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E1896DCDE2DBA323 ON public.pedido_produto (id_pedido)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E1896DCD8231E0A7 ON public.pedido_produto (id_produto)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.produtos (id SERIAL NOT NULL, foto_path VARCHAR(255) DEFAULT NULL, nome VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, preco NUMERIC(10, 2) NOT NULL, categoria VARCHAR(30) DEFAULT NULL, disponibilidade VARCHAR(20) NOT NULL, estoque INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE public.transacao_pagamento (id SERIAL NOT NULL, id_pedido INT DEFAULT NULL, tipo_pagamento VARCHAR(10) DEFAULT NULL, status VARCHAR(20) DEFAULT NULL, valor NUMERIC(10, 2) DEFAULT '0.00' NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_57633B59E2DBA323 ON public.transacao_pagamento (id_pedido)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_de_compras ADD CONSTRAINT FK_E59669FC2A813255 FOREIGN KEY (id_cliente) REFERENCES public.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_produto ADD CONSTRAINT FK_F91848F4F7EA0F55 FOREIGN KEY (id_carrinho) REFERENCES public.carrinho_de_compras (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_produto ADD CONSTRAINT FK_F91848F48231E0A7 FOREIGN KEY (id_produto) REFERENCES public.produtos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.catalogo_produto ADD CONSTRAINT FK_A0313A0BB77787D0 FOREIGN KEY (id_catalogo) REFERENCES public.catalogo (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.catalogo_produto ADD CONSTRAINT FK_A0313A0B8231E0A7 FOREIGN KEY (id_produto) REFERENCES public.produtos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido ADD CONSTRAINT FK_8E0262EE2A813255 FOREIGN KEY (id_cliente) REFERENCES public.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido ADD CONSTRAINT FK_8E0262EECB951B81 FOREIGN KEY (id_carrinho_de_compras) REFERENCES public.carrinho_de_compras (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido_produto ADD CONSTRAINT FK_E1896DCDE2DBA323 FOREIGN KEY (id_pedido) REFERENCES public.pedido (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido_produto ADD CONSTRAINT FK_E1896DCD8231E0A7 FOREIGN KEY (id_produto) REFERENCES public.produtos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.transacao_pagamento ADD CONSTRAINT FK_57633B59E2DBA323 FOREIGN KEY (id_pedido) REFERENCES public.pedido (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_de_compras DROP CONSTRAINT FK_E59669FC2A813255
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_produto DROP CONSTRAINT FK_F91848F4F7EA0F55
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.carrinho_produto DROP CONSTRAINT FK_F91848F48231E0A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.catalogo_produto DROP CONSTRAINT FK_A0313A0BB77787D0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.catalogo_produto DROP CONSTRAINT FK_A0313A0B8231E0A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido DROP CONSTRAINT FK_8E0262EE2A813255
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido DROP CONSTRAINT FK_8E0262EECB951B81
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido_produto DROP CONSTRAINT FK_E1896DCDE2DBA323
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.pedido_produto DROP CONSTRAINT FK_E1896DCD8231E0A7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE public.transacao_pagamento DROP CONSTRAINT FK_57633B59E2DBA323
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.administrador
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.carrinho_de_compras
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.carrinho_produto
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.catalogo
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.catalogo_produto
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.cliente
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.email_confirmacao
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.favoritos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.pedido
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.pedido_produto
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.produtos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE public.transacao_pagamento
        SQL);
    }
}
