<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518102458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE formule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formule_reducer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE formule (id INT NOT NULL, subscription_id INT NOT NULL, formule_reducer_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_605C9C989A1887DC ON formule (subscription_id)');
        $this->addSql('CREATE INDEX IDX_605C9C98F532C3DE ON formule (formule_reducer_id)');
        $this->addSql('CREATE TABLE formule_reducer (id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscription (id INT NOT NULL, compagny_subcription_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C664D335BC8F3E ON subscription (compagny_subcription_id)');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C989A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C98F532C3DE FOREIGN KEY (formule_reducer_id) REFERENCES formule_reducer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D335BC8F3E FOREIGN KEY (compagny_subcription_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE formule_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formule_reducer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscription_id_seq CASCADE');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT FK_605C9C989A1887DC');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT FK_605C9C98F532C3DE');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D335BC8F3E');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE formule_reducer');
        $this->addSql('DROP TABLE subscription');
    }
}
