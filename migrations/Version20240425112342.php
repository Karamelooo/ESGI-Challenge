<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425112342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE annonce_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, selling_price INT DEFAULT NULL, purchase_price INT DEFAULT NULL, tax INT DEFAULT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE annonce DROP CONSTRAINT fk_f65593e52f626dc3');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE annonce');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE annonce_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, profile_picture_url VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('CREATE TABLE annonce (id INT NOT NULL, user_annonce_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f65593e52f626dc3 ON annonce (user_annonce_id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT fk_f65593e52f626dc3 FOREIGN KEY (user_annonce_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE services');
    }
}
