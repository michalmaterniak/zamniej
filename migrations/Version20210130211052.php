<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130211052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shops_affiliation ADD force_active TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX name_type ON shops_affiliation (name, type)');
        $this->addSql('ALTER TABLE convertiser_programs CHANGE geo_targets geo_targets LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE geo_targets_details geo_targets_details LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE goals goals LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE stats stats LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE convertiser_programs CHANGE geo_targets geo_targets JSON NOT NULL, CHANGE geo_targets_details geo_targets_details JSON NOT NULL, CHANGE goals goals JSON NOT NULL, CHANGE stats stats JSON NOT NULL');
        $this->addSql('DROP INDEX name_type ON shops_affiliation');
        $this->addSql('ALTER TABLE shops_affiliation DROP force_active');
    }
}
