<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525174256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tax_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tax (id INT NOT NULL, name VARCHAR(255) NOT NULL, percent INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE services ADD tax_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE services ADD service_number UUID NOT NULL');
        $this->addSql('ALTER TABLE services DROP category');
        $this->addSql('ALTER TABLE services RENAME COLUMN tax TO category_id');
        $this->addSql('ALTER TABLE services RENAME COLUMN last_update TO updated_at');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7332E16912469DE2 ON services (category_id)');
        $this->addSql('CREATE INDEX IDX_7332E169B2A824D8 ON services (tax_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E16912469DE2');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E169B2A824D8');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tax_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE tax');
        $this->addSql('DROP INDEX IDX_7332E16912469DE2');
        $this->addSql('DROP INDEX IDX_7332E169B2A824D8');
        $this->addSql('ALTER TABLE services ADD category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE services ADD tax INT DEFAULT NULL');
        $this->addSql('ALTER TABLE services DROP category_id');
        $this->addSql('ALTER TABLE services DROP tax_id');
        $this->addSql('ALTER TABLE services DROP service_number');
        $this->addSql('ALTER TABLE services RENAME COLUMN updated_at TO last_update');
    }
}
