<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424144500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE compagny_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE compagny (id INT NOT NULL, name VARCHAR(255) NOT NULL, logo_path VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, siret INT DEFAULT NULL, naf VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, capital VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE compagny_id_seq CASCADE');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
