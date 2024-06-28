<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627213853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, invoice_id INT DEFAULT NULL, service_id INT DEFAULT NULL, tax_id INT DEFAULT NULL, reducer INT DEFAULT NULL, quantity SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52993982989F1FD ON "order" (invoice_id)');
        $this->addSql('CREATE INDEX IDX_F5299398ED5CA9E6 ON "order" (service_id)');
        $this->addSql('CREATE INDEX IDX_F5299398B2A824D8 ON "order" (tax_id)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993982989F1FD FOREIGN KEY (invoice_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT fk_c74404551224abe0');
        $this->addSql('DROP INDEX idx_c74404551224abe0');
        $this->addSql('ALTER TABLE client DROP compagny_id');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT fk_6a2f2f9519eb6921');
        $this->addSql('DROP INDEX idx_6a2f2f9519eb6921');
        $this->addSql('ALTER TABLE invoices DROP client_id');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d649979b1ad6');
        $this->addSql('DROP INDEX idx_8d93d649979b1ad6');
        $this->addSql('ALTER TABLE "user" DROP company_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993982989F1FD');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398ED5CA9E6');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398B2A824D8');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('ALTER TABLE invoices ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT fk_6a2f2f9519eb6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6a2f2f9519eb6921 ON invoices (client_id)');
        $this->addSql('ALTER TABLE "user" ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d649979b1ad6 FOREIGN KEY (company_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8d93d649979b1ad6 ON "user" (company_id)');
        $this->addSql('ALTER TABLE client ADD compagny_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT fk_c74404551224abe0 FOREIGN KEY (compagny_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c74404551224abe0 ON client (compagny_id)');
    }
}
