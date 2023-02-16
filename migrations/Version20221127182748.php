<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127182748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'juste for testing authentication';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO "user" values (1,\'test@mail.fr\',\'[{"role":"ROLE_USER"}]\',\'test\')');

        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
