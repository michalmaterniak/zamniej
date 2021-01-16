<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114211904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE convertiser_programs (id_shop INT NOT NULL, id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, logo_thumbnail VARCHAR(600) NOT NULL, preview_url VARCHAR(600) NOT NULL, tracking_url VARCHAR(600) NOT NULL, categories JSON NOT NULL, categories_details JSON NOT NULL, status VARCHAR(255) NOT NULL, status_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_featured TINYINT(1) NOT NULL, currency VARCHAR(5) NOT NULL, currency_details JSON NOT NULL, click_session_lifespan INT NOT NULL, terms LONGTEXT NOT NULL, policy_incentivized TINYINT(1) NOT NULL, policy_cashback TINYINT(1) NOT NULL, policy_coupons TINYINT(1) NOT NULL, policy_search_marketing TINYINT(1) NOT NULL, policy_email_marketing TINYINT(1) NOT NULL, policy_social_media TINYINT(1) NOT NULL, geo_targets LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', geo_targets_details LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', enforce_geo_targeting TINYINT(1) NOT NULL, goals LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', stats LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', has_coupons TINYINT(1) NOT NULL, has_products TINYINT(1) NOT NULL, cpc_rate NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id_shop)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convertiser_programs ADD CONSTRAINT FK_B401561E274A50A0 FOREIGN KEY (id_shop) REFERENCES shops_affiliation (id_shop) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE convertiser_programs');
    }
}
