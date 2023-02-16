<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104204111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station ADD condition_accees VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD reservation BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD horaire VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD accessibilite_pmr VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD restriction_gabarit VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD station2_roue BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD raccordement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD num_pdi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD date_mise_en_service VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD observations VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD date_maj VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD cable_t2_attach VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD last_modified VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD datagouv_dataset_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD data_resource_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD datagouv_organization_or_owner VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD consolidated_longitude VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD consolidated_latitude VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD consolidated_code_commune VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD consolidated_is_lon_lat_correct BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE station ADD consolidated_is_code_insee_verified BOOLEAN DEFAULT false');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE station DROP condition_accees');
        $this->addSql('ALTER TABLE station DROP reservation');
        $this->addSql('ALTER TABLE station DROP horaire');
        $this->addSql('ALTER TABLE station DROP accessibilite_pmr');
        $this->addSql('ALTER TABLE station DROP restriction_gabarit');
        $this->addSql('ALTER TABLE station DROP station2_roue');
        $this->addSql('ALTER TABLE station DROP raccordement');
        $this->addSql('ALTER TABLE station DROP num_pdi');
        $this->addSql('ALTER TABLE station DROP date_mise_en_service');
        $this->addSql('ALTER TABLE station DROP observations');
        $this->addSql('ALTER TABLE station DROP date_maj');
        $this->addSql('ALTER TABLE station DROP cable_t2_attach');
        $this->addSql('ALTER TABLE station DROP last_modified');
        $this->addSql('ALTER TABLE station DROP datagouv_dataset_id');
        $this->addSql('ALTER TABLE station DROP data_resource_id');
        $this->addSql('ALTER TABLE station DROP datagouv_organization_or_owner');
        $this->addSql('ALTER TABLE station DROP consolidated_longitude');
        $this->addSql('ALTER TABLE station DROP consolidated_latitude');
        $this->addSql('ALTER TABLE station DROP consolidated_code_commune');
        $this->addSql('ALTER TABLE station DROP consolidated_is_lon_lat_correct');
        $this->addSql('ALTER TABLE station DROP consolidated_is_code_insee_verified');
    }
}
