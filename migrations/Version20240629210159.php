<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240629210159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compagny DROP CONSTRAINT fk_17a57a042454ba75');
        $this->addSql('DROP INDEX idx_17a57a042454ba75');
        $this->addSql('ALTER TABLE compagny DROP invoices_id');
        $this->addSql('ALTER TABLE invoices ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F95979B1AD6 FOREIGN KEY (company_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6A2F2F95979B1AD6 ON invoices (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compagny ADD invoices_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compagny ADD CONSTRAINT fk_17a57a042454ba75 FOREIGN KEY (invoices_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_17a57a042454ba75 ON compagny (invoices_id)');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F95979B1AD6');
        $this->addSql('DROP INDEX IDX_6A2F2F95979B1AD6');
        $this->addSql('ALTER TABLE invoices DROP company_id');
    }
}
