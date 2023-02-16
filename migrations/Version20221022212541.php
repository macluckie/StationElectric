<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221022212541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE station_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE station (id INT NOT NULL, amenageur VARCHAR(255) DEFAULT NULL, operateur VARCHAR(255) DEFAULT NULL, enseigne VARCHAR(255) DEFAULT NULL, station VARCHAR(255) DEFAULT NULL, id_station VARCHAR(255) DEFAULT NULL, ad_station VARCHAR(255) DEFAULT NULL, code_insee VARCHAR(255) DEFAULT NULL, x_longitude VARCHAR(255) DEFAULT NULL, ylatitude VARCHAR(255) DEFAULT NULL, nbr_pdc VARCHAR(255) DEFAULT NULL, id_pdc VARCHAR(255) DEFAULT NULL, puiss_max VARCHAR(255) DEFAULT NULL, type_prise VARCHAR(255) DEFAULT NULL, acces_recharge VARCHAR(255) DEFAULT NULL, accessibilite VARCHAR(255) DEFAULT NULL, observations VARCHAR(255) DEFAULT NULL, date_maj VARCHAR(255) DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, other VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE station_id_seq CASCADE');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
