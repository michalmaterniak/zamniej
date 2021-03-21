<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210321121306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gsc_indexes (id_index INT AUTO_INCREMENT NOT NULL, subpage_id INT DEFAULT NULL, url VARCHAR(700) NOT NULL, datetime DATETIME NOT NULL, used TINYINT(1) NOT NULL, INDEX IDX_210067EB4724CB2B (subpage_id), PRIMARY KEY(id_index)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gsc_indexes ADD CONSTRAINT FK_210067EB4724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
        $this->addSql('DROP TABLE links_restrict_subpage');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE links_restrict_subpage (id_link INT AUTO_INCREMENT NOT NULL, subpage_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, anchor VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, batch VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, external VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, locale VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E379E6644724CB2B (subpage_id), INDEX IDX_E379E664727ACA70 (parent_id), PRIMARY KEY(id_link)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE links_restrict_subpage ADD CONSTRAINT FK_E379E6644724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE links_restrict_subpage ADD CONSTRAINT FK_E379E664727ACA70 FOREIGN KEY (parent_id) REFERENCES links (id_link) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE gsc_indexes');
    }
}
