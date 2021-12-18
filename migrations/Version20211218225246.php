<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211218225246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tradetracker_programs (id_shop INT NOT NULL, id INT NOT NULL, category JSON NOT NULL, sub_categories JSON NOT NULL, campaign_description LONGTEXT NOT NULL, shop_description LONGTEXT NOT NULL, target_group VARCHAR(255) DEFAULT NULL, characteristics LONGTEXT DEFAULT NULL, image_url VARCHAR(600) NOT NULL, tracking_url VARCHAR(600) NOT NULL, impression_commission NUMERIC(10, 2) NOT NULL, click_commission NUMERIC(10, 2) NOT NULL, fixed_commission NUMERIC(10, 2) NOT NULL, lead_commission NUMERIC(10, 2) NOT NULL, sale_commission_fixed NUMERIC(10, 2) NOT NULL, sale_commission_variable NUMERIC(10, 2) NOT NULL, ilead_commission NUMERIC(10, 2) NOT NULL, isale_commission_fixed NUMERIC(10, 2) NOT NULL, isale_commission_variable NUMERIC(10, 2) NOT NULL, assignment_status VARCHAR(255) NOT NULL, start_date DATETIME DEFAULT NULL, stop_date DATETIME DEFAULT NULL, time_zone VARCHAR(255) NOT NULL, click_to_conversion VARCHAR(255) NOT NULL, policy_search_engine_marketing_status VARCHAR(255) NOT NULL, policy_email_marketing_status VARCHAR(255) NOT NULL, policy_cashback_status VARCHAR(255) NOT NULL, policy_discount_code_status VARCHAR(255) NOT NULL, deeplinking_supported TINYINT(1) NOT NULL, references_supported TINYINT(1) NOT NULL, lead_maximum_assessment_interval VARCHAR(255) DEFAULT NULL, lead_average_assessment_interval VARCHAR(255) DEFAULT NULL, sale_maximum_assessment_interval VARCHAR(255) DEFAULT NULL, sale_average_assessment_interval VARCHAR(255) DEFAULT NULL, attribution_model_lead VARCHAR(255) NOT NULL, attribution_model_sales VARCHAR(255) NOT NULL, PRIMARY KEY(id_shop)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tradetracker_promotions (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, id INT NOT NULL, name VARCHAR(255) NOT NULL, creationDate DATETIME NOT NULL, modification_date DATETIME DEFAULT NULL, reference_supported TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, conditions VARCHAR(255) DEFAULT NULL, valid_from_date DATETIME NOT NULL, valid_to_date DATETIME DEFAULT NULL, discount_fixed NUMERIC(10, 2) DEFAULT NULL, discount_variable NUMERIC(10, 2) DEFAULT NULL, voucher_code VARCHAR(255) DEFAULT NULL, code LONGTEXT NOT NULL, campaign_id INT NOT NULL, campaign_name VARCHAR(255) NOT NULL, url_tracking VARCHAR(600) NOT NULL, url_image VARCHAR(600) DEFAULT NULL, datetime_update DATETIME NOT NULL, INDEX IDX_35765EB73805E320 (shop_affiliation), INDEX IDX_35765EB753C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tradetracker_vouchers (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, id INT NOT NULL, name VARCHAR(255) NOT NULL, creationDate DATETIME NOT NULL, modification_date DATETIME DEFAULT NULL, reference_supported TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, conditions VARCHAR(255) DEFAULT NULL, valid_from_date DATETIME NOT NULL, valid_to_date DATETIME DEFAULT NULL, discount_fixed NUMERIC(10, 2) DEFAULT NULL, discount_variable NUMERIC(10, 2) DEFAULT NULL, voucher_code VARCHAR(255) DEFAULT NULL, code LONGTEXT NOT NULL, campaign_id INT NOT NULL, campaign_name VARCHAR(255) NOT NULL, url_tracking VARCHAR(600) NOT NULL, url_image VARCHAR(600) DEFAULT NULL, datetime_update DATETIME NOT NULL, INDEX IDX_7F3F95C23805E320 (shop_affiliation), INDEX IDX_7F3F95C253C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tradetracker_programs ADD CONSTRAINT FK_1D63F7CF274A50A0 FOREIGN KEY (id_shop) REFERENCES shops_affiliation (id_shop) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tradetracker_promotions ADD CONSTRAINT FK_35765EB73805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE tradetracker_promotions ADD CONSTRAINT FK_35765EB753C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE tradetracker_vouchers ADD CONSTRAINT FK_7F3F95C23805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE tradetracker_vouchers ADD CONSTRAINT FK_7F3F95C253C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tradetracker_programs');
        $this->addSql('DROP TABLE tradetracker_promotions');
        $this->addSql('DROP TABLE tradetracker_vouchers');
    }
}
