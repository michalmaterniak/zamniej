<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426160334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        //wymuszono zmiane collate i recznie edytowano wpis sql
        $this->addSql('ALTER TABLE convertiser_programs CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL');
        $this->addSql('ALTER TABLE convertiser_promotions CHANGE id id VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL');
        $this->addSql('ALTER TABLE convertiser_vouchers CHANGE id id VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL');
        $this->addSql('ALTER TABLE shops_affiliation CHANGE external_id external_id VARCHAR(700) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE convertiser_programs CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE convertiser_promotions CHANGE id id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE convertiser_vouchers CHANGE id id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE shops_affiliation CHANGE external_id external_id VARCHAR(700) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
