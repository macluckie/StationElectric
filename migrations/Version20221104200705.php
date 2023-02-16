<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104200705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station ADD siren_amenageur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD contact_amenageur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD contact_operateur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD telephone_operateur VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD id_station_itenerance VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD id_station_local VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD nom_station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD implantation_station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD address_station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD coordonnees VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD id_pdclocal VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD puiss_nominale VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD prise_type_ef BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD prise_type2 BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD prise_type_combo_ccs BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD prise_type_chademo BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD prise_type_autre BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD gratuit BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD paiment_acte BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD paiment_cb BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD paiment_aautre BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD tarification BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station DROP station');
        $this->addSql('ALTER TABLE station DROP id_station');
        $this->addSql('ALTER TABLE station DROP ad_station');
        $this->addSql('ALTER TABLE station DROP x_longitude');
        $this->addSql('ALTER TABLE station DROP ylatitude');
        $this->addSql('ALTER TABLE station DROP puiss_max');
        $this->addSql('ALTER TABLE station DROP type_prise');
        $this->addSql('ALTER TABLE station DROP acces_recharge');
        $this->addSql('ALTER TABLE station DROP accessibilite');
        $this->addSql('ALTER TABLE station DROP observations');
        $this->addSql('ALTER TABLE station DROP date_maj');
        $this->addSql('ALTER TABLE station DROP source');
        $this->addSql('ALTER TABLE station DROP other');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE station ADD station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD id_station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD ad_station VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD x_longitude VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD ylatitude VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD puiss_max VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD type_prise VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD acces_recharge VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD accessibilite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD observations VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD date_maj VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD source VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD other VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station DROP siren_amenageur');
        $this->addSql('ALTER TABLE station DROP contact_amenageur');
        $this->addSql('ALTER TABLE station DROP contact_operateur');
        $this->addSql('ALTER TABLE station DROP telephone_operateur');
        $this->addSql('ALTER TABLE station DROP id_station_itenerance');
        $this->addSql('ALTER TABLE station DROP id_station_local');
        $this->addSql('ALTER TABLE station DROP nom_station');
        $this->addSql('ALTER TABLE station DROP implantation_station');
        $this->addSql('ALTER TABLE station DROP address_station');
        $this->addSql('ALTER TABLE station DROP coordonnees');
        $this->addSql('ALTER TABLE station DROP id_pdclocal');
        $this->addSql('ALTER TABLE station DROP puiss_nominale');
        $this->addSql('ALTER TABLE station DROP prise_type_ef');
        $this->addSql('ALTER TABLE station DROP prise_type2');
        $this->addSql('ALTER TABLE station DROP prise_type_combo_ccs');
        $this->addSql('ALTER TABLE station DROP prise_type_chademo');
        $this->addSql('ALTER TABLE station DROP prise_type_autre');
        $this->addSql('ALTER TABLE station DROP gratuit');
        $this->addSql('ALTER TABLE station DROP paiment_acte');
        $this->addSql('ALTER TABLE station DROP paiment_cb');
        $this->addSql('ALTER TABLE station DROP paiment_aautre');
        $this->addSql('ALTER TABLE station DROP tarification');
    }
}
