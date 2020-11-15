<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114194240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE webepartners_programs CHANGE affiliate_program_id affiliate_program_id VARCHAR(100) NOT NULL, CHANGE program_logo_url program_logo_url VARCHAR(700) DEFAULT NULL, CHANGE program_url program_url VARCHAR(700) DEFAULT NULL, CHANGE affiliate_tracking_program_url affiliate_tracking_program_url VARCHAR(700) DEFAULT NULL, CHANGE feed_url feed_url VARCHAR(700) DEFAULT NULL');
        $this->addSql('ALTER TABLE webepartners_vouchers CHANGE affiliate_program_id affiliate_program_id VARCHAR(100) NOT NULL, CHANGE voucher_url voucher_url VARCHAR(700) DEFAULT NULL');
        $this->addSql('ALTER TABLE webepartners_banners CHANGE banner_id banner_id VARCHAR(100) NOT NULL, CHANGE short_banner_id short_banner_id VARCHAR(100) DEFAULT NULL, CHANGE landing_url landing_url VARCHAR(700) DEFAULT NULL, CHANGE file_mime file_mime VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE webepartners_promotions CHANGE voucher_id voucher_id VARCHAR(100) NOT NULL, CHANGE affiliate_program_id affiliate_program_id VARCHAR(100) NOT NULL, CHANGE voucher_url voucher_url VARCHAR(700) DEFAULT NULL, CHANGE voucher_type_name voucher_type_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE webepartners_hot_prices CHANGE shop_product_id shop_product_id VARCHAR(100) DEFAULT NULL, CHANGE shop_category_name shop_category_name VARCHAR(700) DEFAULT NULL, CHANGE program_name program_name VARCHAR(200) DEFAULT NULL, CHANGE program_logo_url program_logo_url VARCHAR(700) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE webepartners_banners CHANGE banner_id banner_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE short_banner_id short_banner_id VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE landing_url landing_url VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE file_mime file_mime VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE webepartners_hot_prices CHANGE shop_product_id shop_product_id VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE shop_category_name shop_category_name VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program_name program_name VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program_logo_url program_logo_url VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE webepartners_programs CHANGE affiliate_program_id affiliate_program_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program_logo_url program_logo_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE program_url program_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE affiliate_tracking_program_url affiliate_tracking_program_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE feed_url feed_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE webepartners_promotions CHANGE voucher_id voucher_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE affiliate_program_id affiliate_program_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE voucher_url voucher_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE voucher_type_name voucher_type_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE webepartners_vouchers CHANGE affiliate_program_id affiliate_program_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE voucher_url voucher_url VARCHAR(400) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
