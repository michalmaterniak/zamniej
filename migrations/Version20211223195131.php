<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211223195131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subpage_offers (id INT AUTO_INCREMENT NOT NULL, offer_id INT NOT NULL, subpage_id INT NOT NULL, type VARCHAR(50) NOT NULL, INDEX IDX_FA10918C53C674EE (offer_id), INDEX IDX_FA10918C4724CB2B (subpage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subpage_offers ADD CONSTRAINT FK_FA10918C53C674EE FOREIGN KEY (offer_id) REFERENCES offers (id_offer)');
        $this->addSql('ALTER TABLE subpage_offers ADD CONSTRAINT FK_FA10918C4724CB2B FOREIGN KEY (subpage_id) REFERENCES subpages (id_subpage)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subpage_offers');
    }
}
