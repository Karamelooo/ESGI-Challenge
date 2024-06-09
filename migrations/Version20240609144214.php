<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609144214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE invoices_number_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invoices_number (id INT NOT NULL, invoice_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE invoices ADD invoices_number_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoices ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE invoices DROP archived');
        $this->addSql('COMMENT ON COLUMN invoices.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F958671283 FOREIGN KEY (invoices_number_id) REFERENCES invoices_number (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2F2F958671283 ON invoices (invoices_number_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F958671283');
        $this->addSql('DROP SEQUENCE invoices_number_id_seq CASCADE');
        $this->addSql('DROP TABLE invoices_number');
        $this->addSql('DROP INDEX UNIQ_6A2F2F958671283');
        $this->addSql('ALTER TABLE invoices ADD archived BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE invoices DROP invoices_number_id');
        $this->addSql('ALTER TABLE invoices DROP created_at');
    }
}
