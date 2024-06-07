<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607104218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE email_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formule_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formule_reducer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscription_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, selling_price INT DEFAULT NULL, purchase_price INT DEFAULT NULL, tax INT DEFAULT NULL, last_update DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT fk_a3c664d335bc8f3e');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT fk_605c9c989a1887dc');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT fk_605c9c98f532c3de');
        $this->addSql('DROP TABLE formule_reducer');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE formule');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE email_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formule_reducer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE formule_reducer (id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE email (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscription (id INT NOT NULL, compagny_subcription_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_a3c664d335bc8f3e ON subscription (compagny_subcription_id)');
        $this->addSql('CREATE TABLE formule (id INT NOT NULL, subscription_id INT NOT NULL, formule_reducer_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_605c9c98f532c3de ON formule (formule_reducer_id)');
        $this->addSql('CREATE INDEX idx_605c9c989a1887dc ON formule (subscription_id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT fk_a3c664d335bc8f3e FOREIGN KEY (compagny_subcription_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT fk_605c9c989a1887dc FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT fk_605c9c98f532c3de FOREIGN KEY (formule_reducer_id) REFERENCES formule_reducer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE services');
    }
}
