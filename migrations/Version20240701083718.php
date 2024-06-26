<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701083718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE compagny_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formule_reducer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoice_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoices_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoices_number_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_method_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE services_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tax_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, company VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, siret INT DEFAULT NULL, naf VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE compagny (id INT NOT NULL, invoices_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, logo_path VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, naf VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, capital VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17A57A042454BA75 ON compagny (invoices_id)');
        $this->addSql('CREATE TABLE formule (id INT NOT NULL, subscription_id INT NOT NULL, formule_reducer_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_605C9C989A1887DC ON formule (subscription_id)');
        $this->addSql('CREATE INDEX IDX_605C9C98F532C3DE ON formule (formule_reducer_id)');
        $this->addSql('CREATE TABLE formule_reducer (id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE invoice_status (id INT NOT NULL, invoices_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C036F84F2454BA75 ON invoice_status (invoices_id)');
        $this->addSql('CREATE TABLE invoices (id INT NOT NULL, invoices_number_id INT DEFAULT NULL, client_id INT DEFAULT NULL, last_payment_date DATE DEFAULT NULL, last_send_date DATE DEFAULT NULL, due_date DATE DEFAULT NULL, update_at DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2F2F958671283 ON invoices (invoices_number_id)');
        $this->addSql('CREATE INDEX IDX_6A2F2F9519EB6921 ON invoices (client_id)');
        $this->addSql('COMMENT ON COLUMN invoices.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE invoices_number (id INT NOT NULL, invoice_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, invoice_id INT DEFAULT NULL, service_id INT DEFAULT NULL, tax_id INT DEFAULT NULL, reducer INT DEFAULT NULL, quantity SMALLINT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52993982989F1FD ON "order" (invoice_id)');
        $this->addSql('CREATE INDEX IDX_F5299398ED5CA9E6 ON "order" (service_id)');
        $this->addSql('CREATE INDEX IDX_F5299398B2A824D8 ON "order" (tax_id)');
        $this->addSql('CREATE TABLE payment (id INT NOT NULL, invoices_id INT DEFAULT NULL, amount INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D28840D2454BA75 ON payment (invoices_id)');
        $this->addSql('CREATE TABLE payment_method (id INT NOT NULL, payment_id INT DEFAULT NULL, method VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B61A1F64C3A3BB ON payment_method (payment_id)');
        $this->addSql('CREATE TABLE services (id INT NOT NULL, category_id INT DEFAULT NULL, tax_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, purchase_price INT DEFAULT NULL, selling_price INT DEFAULT NULL, updated_at DATE NOT NULL, status BOOLEAN NOT NULL, service_number UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7332E169A8571A62 ON services (service_number)');
        $this->addSql('CREATE INDEX IDX_7332E16912469DE2 ON services (category_id)');
        $this->addSql('CREATE INDEX IDX_7332E169B2A824D8 ON services (tax_id)');
        $this->addSql('CREATE TABLE subscription (id INT NOT NULL, compagny_subcription_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C664D335BC8F3E ON subscription (compagny_subcription_id)');
        $this->addSql('CREATE TABLE tax (id INT NOT NULL, name VARCHAR(255) NOT NULL, percent INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, company_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_connection_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, invoice_id INT DEFAULT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON "user" (company_id)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".last_connection_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE compagny ADD CONSTRAINT FK_17A57A042454BA75 FOREIGN KEY (invoices_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C989A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C98F532C3DE FOREIGN KEY (formule_reducer_id) REFERENCES formule_reducer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_status ADD CONSTRAINT FK_C036F84F2454BA75 FOREIGN KEY (invoices_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F958671283 FOREIGN KEY (invoices_number_id) REFERENCES invoices_number (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F9519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993982989F1FD FOREIGN KEY (invoice_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D2454BA75 FOREIGN KEY (invoices_id) REFERENCES invoices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_method ADD CONSTRAINT FK_7B61A1F64C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169B2A824D8 FOREIGN KEY (tax_id) REFERENCES tax (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D335BC8F3E FOREIGN KEY (compagny_subcription_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE compagny_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formule_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formule_reducer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoice_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoices_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoices_number_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE payment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_method_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE services_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscription_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tax_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE compagny DROP CONSTRAINT FK_17A57A042454BA75');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT FK_605C9C989A1887DC');
        $this->addSql('ALTER TABLE formule DROP CONSTRAINT FK_605C9C98F532C3DE');
        $this->addSql('ALTER TABLE invoice_status DROP CONSTRAINT FK_C036F84F2454BA75');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F958671283');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F9519EB6921');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993982989F1FD');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398ED5CA9E6');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398B2A824D8');
        $this->addSql('ALTER TABLE payment DROP CONSTRAINT FK_6D28840D2454BA75');
        $this->addSql('ALTER TABLE payment_method DROP CONSTRAINT FK_7B61A1F64C3A3BB');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E16912469DE2');
        $this->addSql('ALTER TABLE services DROP CONSTRAINT FK_7332E169B2A824D8');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D335BC8F3E');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649979B1AD6');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE formule_reducer');
        $this->addSql('DROP TABLE invoice_status');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE invoices_number');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE tax');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
