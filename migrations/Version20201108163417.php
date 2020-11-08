<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201108163417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE settings (id_setting VARCHAR(200) NOT NULL, settings JSON NOT NULL, PRIMARY KEY(id_setting)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, resource_id INT DEFAULT NULL, name VARCHAR(700) NOT NULL, UNIQUE INDEX UNIQ_3AF3466889329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_api_token (id_token INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(600) NOT NULL, datetime_expired DATETIME NOT NULL, ip VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_1DDF8F0A5F37A13B (token), INDEX IDX_1DDF8F0AA76ED395 (user_id), PRIMARY KEY(id_token)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(500) NOT NULL, firstname VARCHAR(200) NOT NULL, lastname VARCHAR(200) NOT NULL, password VARCHAR(200) NOT NULL, active TINYINT(1) NOT NULL, `admin` TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id_file INT AUTO_INCREMENT NOT NULL, group_name VARCHAR(300) NOT NULL, file VARCHAR(300) NOT NULL, folder VARCHAR(300) NOT NULL, type SMALLINT NOT NULL, settings JSON NOT NULL, data JSON NOT NULL, PRIMARY KEY(id_file)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contents (id_content INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, data JSON NOT NULL, PRIMARY KEY(id_content)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identify_persons (id_identify_person INT AUTO_INCREMENT NOT NULL, request JSON NOT NULL, datetime_create DATETIME NOT NULL, PRIMARY KEY(id_identify_person)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slides (id_slide INT AUTO_INCREMENT NOT NULL, slider_id INT NOT NULL, photo_id INT NOT NULL, offer_id INT DEFAULT NULL, datetime_from DATETIME NOT NULL, datetime_to DATETIME DEFAULT NULL, link VARCHAR(700) NOT NULL, content LONGTEXT NOT NULL, header VARCHAR(700) NOT NULL, data JSON NOT NULL, type INT NOT NULL, INDEX IDX_B8C020912CCC9638 (slider_id), INDEX IDX_B8C020917E9E4C8C (photo_id), INDEX IDX_B8C0209153C674EE (offer_id), PRIMARY KEY(id_slide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sliders (id_slider INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, description VARCHAR(300) NOT NULL, type INT NOT NULL, UNIQUE INDEX UNIQ_85A59DB85E237E06 (name), PRIMARY KEY(id_slider)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slides_products (id_slide INT NOT NULL, PRIMARY KEY(id_slide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slides_promotions (id_slide INT NOT NULL, PRIMARY KEY(id_slide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slides_banners (id_slide INT NOT NULL, PRIMARY KEY(id_slide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slides_vouchers (id_slide INT NOT NULL, code VARCHAR(50) NOT NULL, PRIMARY KEY(id_slide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE links (id_link INT AUTO_INCREMENT NOT NULL, subpage_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, anchor VARCHAR(200) NOT NULL, batch VARCHAR(50) NOT NULL, external VARCHAR(200) DEFAULT NULL, locale VARCHAR(10) NOT NULL, INDEX IDX_D182A1184724CB2B (subpage_id), INDEX IDX_D182A118727ACA70 (parent_id), PRIMARY KEY(id_link)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE links_restrict_subpage (id_link INT AUTO_INCREMENT NOT NULL, subpage_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, anchor VARCHAR(200) NOT NULL, batch VARCHAR(50) NOT NULL, external VARCHAR(200) DEFAULT NULL, locale VARCHAR(10) NOT NULL, INDEX IDX_E379E6644724CB2B (subpage_id), INDEX IDX_E379E664727ACA70 (parent_id), PRIMARY KEY(id_link)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shops_affiliation (id_shop INT AUTO_INCREMENT NOT NULL, shop_id INT DEFAULT NULL, affiliation_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, is_new TINYINT(1) NOT NULL, enable TINYINT(1) NOT NULL, url_logo VARCHAR(600) DEFAULT NULL, redirect_count INT DEFAULT NULL, type INT NOT NULL, INDEX IDX_806E32524D16C4DD (shop_id), INDEX IDX_806E3252CB94D64E (affiliation_id), UNIQUE INDEX name_type (name, type), PRIMARY KEY(id_shop)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiliations (id_affiliation INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, data JSON NOT NULL, PRIMARY KEY(id_affiliation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webepartners_programs (id_shop INT NOT NULL, program_id INT NOT NULL, affiliate_program_id VARCHAR(50) NOT NULL, create_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, program_name VARCHAR(100) NOT NULL, program_logo_url VARCHAR(400) DEFAULT NULL, program_url VARCHAR(400) DEFAULT NULL, affiliate_tracking_program_url VARCHAR(400) DEFAULT NULL, is_banner TINYINT(1) NOT NULL, is_deeplink TINYINT(1) NOT NULL, is_widget TINYINT(1) NOT NULL, is_xml TINYINT(1) NOT NULL, is_vouchers TINYINT(1) NOT NULL, is_mailing TINYINT(1) NOT NULL, cpc_commission NUMERIC(10, 2) NOT NULL, cps_commission NUMERIC(10, 2) NOT NULL, lead_commission NUMERIC(10, 2) NOT NULL, cookies_time INT NOT NULL, relation_id SMALLINT NOT NULL, feed_url VARCHAR(400) DEFAULT NULL, PRIMARY KEY(id_shop)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webepartners_vouchers (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, voucher_id VARCHAR(50) NOT NULL, voucher_name VARCHAR(200) DEFAULT NULL, voucher_code VARCHAR(200) DEFAULT NULL, voucher_text LONGTEXT DEFAULT NULL, date_from DATETIME NOT NULL, date_to DATETIME NOT NULL, program_id INT NOT NULL, affiliate_program_id VARCHAR(50) NOT NULL, program_name VARCHAR(200) DEFAULT NULL, voucher_url VARCHAR(400) DEFAULT NULL, voucher_tracking_url VARCHAR(700) DEFAULT NULL, voucher_type_id INT NOT NULL, voucher_type_name VARCHAR(20) DEFAULT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_1225E7B128AA1B6F (voucher_id), INDEX IDX_1225E7B13805E320 (shop_affiliation), INDEX IDX_1225E7B153C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webepartners_banners (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, program_id INT NOT NULL, banner_id VARCHAR(50) NOT NULL, short_banner_id VARCHAR(50) DEFAULT NULL, width INT NOT NULL, height INT NOT NULL, public_date DATETIME NOT NULL, unpublic_date DATETIME DEFAULT NULL, landing_url VARCHAR(200) DEFAULT NULL, file_mime VARCHAR(20) DEFAULT NULL, banner_image_url VARCHAR(700) DEFAULT NULL, banner_tracking_url VARCHAR(700) DEFAULT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_ABF911BC684EC833 (banner_id), INDEX IDX_ABF911BC3805E320 (shop_affiliation), INDEX IDX_ABF911BC53C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webepartners_promotions (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, voucher_id VARCHAR(50) NOT NULL, voucher_name VARCHAR(200) DEFAULT NULL, voucher_text LONGTEXT DEFAULT NULL, date_from DATETIME NOT NULL, date_to DATETIME NOT NULL, program_id INT NOT NULL, affiliate_program_id VARCHAR(50) NOT NULL, program_name VARCHAR(200) DEFAULT NULL, voucher_url VARCHAR(400) DEFAULT NULL, voucher_tracking_url VARCHAR(700) DEFAULT NULL, voucher_type_id INT NOT NULL, voucher_type_name VARCHAR(20) DEFAULT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_8F6F098828AA1B6F (voucher_id), INDEX IDX_8F6F09883805E320 (shop_affiliation), INDEX IDX_8F6F098853C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webepartners_hot_prices (id_offer INT AUTO_INCREMENT NOT NULL, shop_affiliation INT NOT NULL, offer_id INT DEFAULT NULL, webe_product_id VARCHAR(100) DEFAULT NULL, shop_product_id VARCHAR(10) DEFAULT NULL, shop_category_name VARCHAR(400) DEFAULT NULL, category JSON NOT NULL, product_name VARCHAR(400) DEFAULT NULL, product_descritption LONGTEXT DEFAULT NULL, product_images JSON NOT NULL, product_brand VARCHAR(100) DEFAULT NULL, program_id INT NOT NULL, program_name VARCHAR(100) DEFAULT NULL, program_logo_url VARCHAR(200) DEFAULT NULL, product_tracking_url VARCHAR(700) DEFAULT NULL, ean VARCHAR(50) DEFAULT NULL, isbn VARCHAR(50) DEFAULT NULL, product_price NUMERIC(10, 2) NOT NULL, price_cut NUMERIC(10, 2) NOT NULL, previous_price JSON NOT NULL, datetime_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_6F9A91F5D1E664D6 (webe_product_id), INDEX IDX_6F9A91F53805E320 (shop_affiliation), INDEX IDX_6F9A91F553C674EE (offer_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resources (id_resource INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, content_id INT DEFAULT NULL, name VARCHAR(700) NOT NULL, active TINYINT(1) NOT NULL, deep INT NOT NULL, count_children INT NOT NULL, datetime_create DATETIME NOT NULL, resource_type SMALLINT NOT NULL, resource_id INT NOT NULL, UNIQUE INDEX UNIQ_EF66EBAE642B8210 (admin_id), INDEX IDX_EF66EBAE727ACA70 (parent_id), UNIQUE INDEX UNIQ_EF66EBAE84A0A3ED (content_id), UNIQUE INDEX name_parent (name, parent_id), UNIQUE INDEX resource_type_resource_id (resource_type, resource_id), PRIMARY KEY(id_resource)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map_parents_resources (resource_id INT NOT NULL, parent_id INT NOT NULL, INDEX IDX_7AD0E3C289329D25 (resource_id), INDEX IDX_7AD0E3C2727ACA70 (parent_id), PRIMARY KEY(resource_id, parent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files_resources (resource_id INT NOT NULL, file_id INT NOT NULL, INDEX IDX_97948C1589329D25 (resource_id), UNIQUE INDEX UNIQ_97948C1593CB796C (file_id), PRIMARY KEY(resource_id, file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_subpage (id_seo INT AUTO_INCREMENT NOT NULL, title VARCHAR(500) DEFAULT NULL, header VARCHAR(500) DEFAULT NULL, description LONGTEXT DEFAULT NULL, canonical VARCHAR(500) DEFAULT NULL, data JSON NOT NULL, PRIMARY KEY(id_seo)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resources_config (id_resource_admin INT AUTO_INCREMENT NOT NULL, editable TINYINT(1) NOT NULL, removable TINYINT(1) NOT NULL, unactivable TINYINT(1) NOT NULL, final TINYINT(1) NOT NULL, hidden TINYINT(1) NOT NULL, slug VARCHAR(700) NOT NULL, PRIMARY KEY(id_resource_admin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subpages (id_subpage INT AUTO_INCREMENT NOT NULL, resource_id INT NOT NULL, content_id INT DEFAULT NULL, seo_id INT DEFAULT NULL, locale VARCHAR(5) NOT NULL, slug VARCHAR(500) NOT NULL, path VARCHAR(500) NOT NULL, active TINYINT(1) NOT NULL, name VARCHAR(700) NOT NULL, datetime_create DATETIME NOT NULL, data JSON NOT NULL, UNIQUE INDEX UNIQ_5AC70AAF5E237E06 (name), INDEX IDX_5AC70AAF89329D25 (resource_id), UNIQUE INDEX UNIQ_5AC70AAF84A0A3ED (content_id), UNIQUE INDEX UNIQ_5AC70AAF97E3DD86 (seo_id), UNIQUE INDEX locale_slug (locale, slug), UNIQUE INDEX resource_locale (resource_id, locale), PRIMARY KEY(id_subpage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files_subpages (subpage_id INT NOT NULL, file_id INT NOT NULL, INDEX IDX_AF6913E74724CB2B (subpage_id), UNIQUE INDEX UNIQ_AF6913E793CB796C (file_id), PRIMARY KEY(subpage_id, file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, resource_id INT DEFAULT NULL, name VARCHAR(700) NOT NULL, UNIQUE INDEX UNIQ_2074E57589329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE homepages (id_homepage INT AUTO_INCREMENT NOT NULL, resource_id INT DEFAULT NULL, name VARCHAR(700) NOT NULL, UNIQUE INDEX UNIQ_5C7724A189329D25 (resource_id), PRIMARY KEY(id_homepage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_opinions (id_shop_opinion INT AUTO_INCREMENT NOT NULL, identify_person_id INT DEFAULT NULL, subpage_id INT NOT NULL, name VARCHAR(50) NOT NULL, comment LONGTEXT NOT NULL, rating SMALLINT DEFAULT NULL, accept TINYINT(1) NOT NULL, admin_created TINYINT(1) NOT NULL, datetime_create DATETIME NOT NULL, priority SMALLINT NOT NULL, UNIQUE INDEX UNIQ_6517824623A3596C (identify_person_id), INDEX IDX_651782464724CB2B (subpage_id), PRIMARY KEY(id_shop_opinion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_tags_translate (id_tag INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, name VARCHAR(50) NOT NULL, locale VARCHAR(10) NOT NULL, INDEX IDX_BEB05C2DBAD26311 (tag_id), UNIQUE INDEX name_locale (name, locale), PRIMARY KEY(id_tag)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_tags (id_tag INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id_tag)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shops (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, resource_id INT DEFAULT NULL, priority SMALLINT NOT NULL, name VARCHAR(700) NOT NULL, INDEX IDX_237A6783BAD26311 (tag_id), UNIQUE INDEX UNIQ_237A678389329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id_offer INT AUTO_INCREMENT NOT NULL, content_id INT DEFAULT NULL, shop_affiliation INT NOT NULL, photo_id INT DEFAULT NULL, subpage_id INT NOT NULL, offer_liking_id INT NOT NULL, datetime_from DATETIME NOT NULL, datetime_to DATETIME DEFAULT NULL, url VARCHAR(700) DEFAULT NULL, title VARCHAR(400) NOT NULL, datetime_update DATETIME NOT NULL, datetime_create DATETIME NOT NULL, redirect_count INT NOT NULL, active TINYINT(1) NOT NULL, data JSON NOT NULL, type INT NOT NULL, INDEX IDX_DA46042784A0A3ED (content_id), INDEX IDX_DA4604273805E320 (shop_affiliation), INDEX IDX_DA4604277E9E4C8C (photo_id), INDEX IDX_DA4604274724CB2B (subpage_id), INDEX IDX_DA4604278F86FC73 (offer_liking_id), PRIMARY KEY(id_offer)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_likings (id_offer_liking INT AUTO_INCREMENT NOT NULL, count_negative INT NOT NULL, count_positive INT NOT NULL, PRIMARY KEY(id_offer_liking)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF3466889329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE users_api_token ADD CONSTRAINT FK_1DDF8F0AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slides ADD CONSTRAINT FK_B8C020912CCC9638 FOREIGN KEY (slider_id) REFERENCES sliders (id_slider)');
        $this->addSql('ALTER TABLE slides ADD CONSTRAINT FK_B8C020917E9E4C8C FOREIGN KEY (photo_id) REFERENCES files (id_file)');
        $this->addSql('ALTER TABLE slides ADD CONSTRAINT FK_B8C0209153C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE slides_products ADD CONSTRAINT FK_836625829C6AAF52 FOREIGN KEY (id_slide) REFERENCES slides (id_slide) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slides_promotions ADD CONSTRAINT FK_634023529C6AAF52 FOREIGN KEY (id_slide) REFERENCES slides (id_slide) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slides_banners ADD CONSTRAINT FK_4C8F14879C6AAF52 FOREIGN KEY (id_slide) REFERENCES slides (id_slide) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE slides_vouchers ADD CONSTRAINT FK_A3C978909C6AAF52 FOREIGN KEY (id_slide) REFERENCES slides (id_slide) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A1184724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A118727ACA70 FOREIGN KEY (parent_id) REFERENCES links (id_link)');
        $this->addSql('ALTER TABLE links_restrict_subpage ADD CONSTRAINT FK_E379E6644724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
        $this->addSql('ALTER TABLE links_restrict_subpage ADD CONSTRAINT FK_E379E664727ACA70 FOREIGN KEY (parent_id) REFERENCES links (id_link)');
        $this->addSql('ALTER TABLE shops_affiliation ADD CONSTRAINT FK_806E32524D16C4DD FOREIGN KEY (shop_id) REFERENCES subpages (id_subpage) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE shops_affiliation ADD CONSTRAINT FK_806E3252CB94D64E FOREIGN KEY (affiliation_id) REFERENCES affiliations (id_affiliation)');
        $this->addSql('ALTER TABLE webepartners_programs ADD CONSTRAINT FK_707985BC274A50A0 FOREIGN KEY (id_shop) REFERENCES shops_affiliation (id_shop) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE webepartners_vouchers ADD CONSTRAINT FK_1225E7B13805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE webepartners_vouchers ADD CONSTRAINT FK_1225E7B153C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE webepartners_banners ADD CONSTRAINT FK_ABF911BC3805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE webepartners_banners ADD CONSTRAINT FK_ABF911BC53C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE webepartners_promotions ADD CONSTRAINT FK_8F6F09883805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE webepartners_promotions ADD CONSTRAINT FK_8F6F098853C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE webepartners_hot_prices ADD CONSTRAINT FK_6F9A91F53805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE webepartners_hot_prices ADD CONSTRAINT FK_6F9A91F553C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE resources ADD CONSTRAINT FK_EF66EBAE642B8210 FOREIGN KEY (admin_id) REFERENCES resources_config (id_resource_admin)');
        $this->addSql('ALTER TABLE resources ADD CONSTRAINT FK_EF66EBAE727ACA70 FOREIGN KEY (parent_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE resources ADD CONSTRAINT FK_EF66EBAE84A0A3ED FOREIGN KEY (content_id) REFERENCES contents (id_content) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE map_parents_resources ADD CONSTRAINT FK_7AD0E3C289329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE map_parents_resources ADD CONSTRAINT FK_7AD0E3C2727ACA70 FOREIGN KEY (parent_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE files_resources ADD CONSTRAINT FK_97948C1589329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE files_resources ADD CONSTRAINT FK_97948C1593CB796C FOREIGN KEY (file_id) REFERENCES files (id_file)');
        $this->addSql('ALTER TABLE subpages ADD CONSTRAINT FK_5AC70AAF89329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subpages ADD CONSTRAINT FK_5AC70AAF84A0A3ED FOREIGN KEY (content_id) REFERENCES contents (id_content) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subpages ADD CONSTRAINT FK_5AC70AAF97E3DD86 FOREIGN KEY (seo_id) REFERENCES seo_subpage (id_seo)');
        $this->addSql('ALTER TABLE files_subpages ADD CONSTRAINT FK_AF6913E74724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE files_subpages ADD CONSTRAINT FK_AF6913E793CB796C FOREIGN KEY (file_id) REFERENCES files (id_file)');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E57589329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE homepages ADD CONSTRAINT FK_5C7724A189329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE shop_opinions ADD CONSTRAINT FK_6517824623A3596C FOREIGN KEY (identify_person_id) REFERENCES identify_persons (id_identify_person)');
        $this->addSql('ALTER TABLE shop_opinions ADD CONSTRAINT FK_651782464724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
        $this->addSql('ALTER TABLE shop_tags_translate ADD CONSTRAINT FK_BEB05C2DBAD26311 FOREIGN KEY (tag_id) REFERENCES shop_tags (id_tag)');
        $this->addSql('ALTER TABLE shops ADD CONSTRAINT FK_237A6783BAD26311 FOREIGN KEY (tag_id) REFERENCES shop_tags (id_tag)');
        $this->addSql('ALTER TABLE shops ADD CONSTRAINT FK_237A678389329D25 FOREIGN KEY (resource_id) REFERENCES resources (id_resource)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA46042784A0A3ED FOREIGN KEY (content_id) REFERENCES contents (id_content)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604273805E320 FOREIGN KEY (shop_affiliation) REFERENCES shops_affiliation (id_shop)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604277E9E4C8C FOREIGN KEY (photo_id) REFERENCES files (id_file)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604274724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604278F86FC73 FOREIGN KEY (offer_liking_id) REFERENCES offer_likings (id_offer_liking) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_api_token DROP FOREIGN KEY FK_1DDF8F0AA76ED395');
        $this->addSql('ALTER TABLE slides DROP FOREIGN KEY FK_B8C020917E9E4C8C');
        $this->addSql('ALTER TABLE files_resources DROP FOREIGN KEY FK_97948C1593CB796C');
        $this->addSql('ALTER TABLE files_subpages DROP FOREIGN KEY FK_AF6913E793CB796C');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604277E9E4C8C');
        $this->addSql('ALTER TABLE resources DROP FOREIGN KEY FK_EF66EBAE84A0A3ED');
        $this->addSql('ALTER TABLE subpages DROP FOREIGN KEY FK_5AC70AAF84A0A3ED');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA46042784A0A3ED');
        $this->addSql('ALTER TABLE shop_opinions DROP FOREIGN KEY FK_6517824623A3596C');
        $this->addSql('ALTER TABLE slides_products DROP FOREIGN KEY FK_836625829C6AAF52');
        $this->addSql('ALTER TABLE slides_promotions DROP FOREIGN KEY FK_634023529C6AAF52');
        $this->addSql('ALTER TABLE slides_banners DROP FOREIGN KEY FK_4C8F14879C6AAF52');
        $this->addSql('ALTER TABLE slides_vouchers DROP FOREIGN KEY FK_A3C978909C6AAF52');
        $this->addSql('ALTER TABLE slides DROP FOREIGN KEY FK_B8C020912CCC9638');
        $this->addSql('ALTER TABLE links DROP FOREIGN KEY FK_D182A118727ACA70');
        $this->addSql('ALTER TABLE links_restrict_subpage DROP FOREIGN KEY FK_E379E664727ACA70');
        $this->addSql('ALTER TABLE webepartners_programs DROP FOREIGN KEY FK_707985BC274A50A0');
        $this->addSql('ALTER TABLE webepartners_vouchers DROP FOREIGN KEY FK_1225E7B13805E320');
        $this->addSql('ALTER TABLE webepartners_banners DROP FOREIGN KEY FK_ABF911BC3805E320');
        $this->addSql('ALTER TABLE webepartners_promotions DROP FOREIGN KEY FK_8F6F09883805E320');
        $this->addSql('ALTER TABLE webepartners_hot_prices DROP FOREIGN KEY FK_6F9A91F53805E320');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604273805E320');
        $this->addSql('ALTER TABLE shops_affiliation DROP FOREIGN KEY FK_806E3252CB94D64E');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF3466889329D25');
        $this->addSql('ALTER TABLE resources DROP FOREIGN KEY FK_EF66EBAE727ACA70');
        $this->addSql('ALTER TABLE map_parents_resources DROP FOREIGN KEY FK_7AD0E3C289329D25');
        $this->addSql('ALTER TABLE map_parents_resources DROP FOREIGN KEY FK_7AD0E3C2727ACA70');
        $this->addSql('ALTER TABLE files_resources DROP FOREIGN KEY FK_97948C1589329D25');
        $this->addSql('ALTER TABLE subpages DROP FOREIGN KEY FK_5AC70AAF89329D25');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E57589329D25');
        $this->addSql('ALTER TABLE homepages DROP FOREIGN KEY FK_5C7724A189329D25');
        $this->addSql('ALTER TABLE shops DROP FOREIGN KEY FK_237A678389329D25');
        $this->addSql('ALTER TABLE subpages DROP FOREIGN KEY FK_5AC70AAF97E3DD86');
        $this->addSql('ALTER TABLE resources DROP FOREIGN KEY FK_EF66EBAE642B8210');
        $this->addSql('ALTER TABLE links DROP FOREIGN KEY FK_D182A1184724CB2B');
        $this->addSql('ALTER TABLE links_restrict_subpage DROP FOREIGN KEY FK_E379E6644724CB2B');
        $this->addSql('ALTER TABLE shops_affiliation DROP FOREIGN KEY FK_806E32524D16C4DD');
        $this->addSql('ALTER TABLE files_subpages DROP FOREIGN KEY FK_AF6913E74724CB2B');
        $this->addSql('ALTER TABLE shop_opinions DROP FOREIGN KEY FK_651782464724CB2B');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604274724CB2B');
        $this->addSql('ALTER TABLE shop_tags_translate DROP FOREIGN KEY FK_BEB05C2DBAD26311');
        $this->addSql('ALTER TABLE shops DROP FOREIGN KEY FK_237A6783BAD26311');
        $this->addSql('ALTER TABLE slides DROP FOREIGN KEY FK_B8C0209153C674EE');
        $this->addSql('ALTER TABLE webepartners_vouchers DROP FOREIGN KEY FK_1225E7B153C674EE');
        $this->addSql('ALTER TABLE webepartners_banners DROP FOREIGN KEY FK_ABF911BC53C674EE');
        $this->addSql('ALTER TABLE webepartners_promotions DROP FOREIGN KEY FK_8F6F098853C674EE');
        $this->addSql('ALTER TABLE webepartners_hot_prices DROP FOREIGN KEY FK_6F9A91F553C674EE');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604278F86FC73');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE users_api_token');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE contents');
        $this->addSql('DROP TABLE identify_persons');
        $this->addSql('DROP TABLE slides');
        $this->addSql('DROP TABLE sliders');
        $this->addSql('DROP TABLE slides_products');
        $this->addSql('DROP TABLE slides_promotions');
        $this->addSql('DROP TABLE slides_banners');
        $this->addSql('DROP TABLE slides_vouchers');
        $this->addSql('DROP TABLE links');
        $this->addSql('DROP TABLE links_restrict_subpage');
        $this->addSql('DROP TABLE shops_affiliation');
        $this->addSql('DROP TABLE affiliations');
        $this->addSql('DROP TABLE webepartners_programs');
        $this->addSql('DROP TABLE webepartners_vouchers');
        $this->addSql('DROP TABLE webepartners_banners');
        $this->addSql('DROP TABLE webepartners_promotions');
        $this->addSql('DROP TABLE webepartners_hot_prices');
        $this->addSql('DROP TABLE resources');
        $this->addSql('DROP TABLE map_parents_resources');
        $this->addSql('DROP TABLE files_resources');
        $this->addSql('DROP TABLE seo_subpage');
        $this->addSql('DROP TABLE resources_config');
        $this->addSql('DROP TABLE subpages');
        $this->addSql('DROP TABLE files_subpages');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE homepages');
        $this->addSql('DROP TABLE shop_opinions');
        $this->addSql('DROP TABLE shop_tags_translate');
        $this->addSql('DROP TABLE shop_tags');
        $this->addSql('DROP TABLE shops');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE offer_likings');
    }
}
