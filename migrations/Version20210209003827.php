<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209003827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE convertiser_promotions (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, id VARCHAR(50) NOT NULL, title LONGTEXT DEFAULT NULL, short_title VARCHAR(500) DEFAULT NULL, logo_thumbnail VARCHAR(700) NOT NULL, type VARCHAR(50) NOT NULL, type_name VARCHAR(50) NOT NULL, subtype VARCHAR(50) NOT NULL, subtype_name VARCHAR(50) NOT NULL, offer_external_id VARCHAR(50) NOT NULL, offer_details JSON NOT NULL, promo_code VARCHAR(200) NOT NULL, exclusive TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, categories JSON NOT NULL, categories_details JSON NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, is_expired TINYINT(1) NOT NULL, url_tracking VARCHAR(700) NOT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_C8490F5BF396750 (id), INDEX IDX_C8490F53805E320 (shop_affiliation), INDEX IDX_C8490F553C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE convertiser_vouchers (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, id VARCHAR(50) NOT NULL, title LONGTEXT DEFAULT NULL, short_title VARCHAR(500) DEFAULT NULL, logo_thumbnail VARCHAR(700) NOT NULL, type VARCHAR(50) NOT NULL, type_name VARCHAR(50) NOT NULL, subtype VARCHAR(50) NOT NULL, subtype_name VARCHAR(50) NOT NULL, offer_external_id VARCHAR(50) NOT NULL, offer_details JSON NOT NULL, promo_code VARCHAR(200) NOT NULL, exclusive TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, categories JSON NOT NULL, categories_details JSON NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, is_expired TINYINT(1) NOT NULL, url_tracking VARCHAR(700) NOT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_D65D3413BF396750 (id), INDEX IDX_D65D34133805E320 (shop_affiliation), INDEX IDX_D65D341353C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convertiser_promotions ADD CONSTRAINT FK_C8490F53805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE convertiser_promotions ADD CONSTRAINT FK_C8490F553C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE convertiser_vouchers ADD CONSTRAINT FK_D65D34133805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE convertiser_vouchers ADD CONSTRAINT FK_D65D341353C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE convertiser_promotions');
        $this->addSql('DROP TABLE convertiser_vouchers');
    }
}
