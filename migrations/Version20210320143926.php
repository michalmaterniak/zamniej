<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320143926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gsc_indexes ADD subpage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gsc_indexes ADD CONSTRAINT FK_210067EB4724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
        $this->addSql('CREATE INDEX IDX_210067EB4724CB2B ON gsc_indexes (subpage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gsc_indexes DROP FOREIGN KEY FK_210067EB4724CB2B');
        $this->addSql('DROP INDEX IDX_210067EB4724CB2B ON gsc_indexes');
        $this->addSql('ALTER TABLE gsc_indexes DROP subpage_id');
    }
}
