<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910232006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE temoignage ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE temoignage ADD CONSTRAINT FK_BDADBC463256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BDADBC463256915B ON temoignage (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE temoignage DROP FOREIGN KEY FK_BDADBC463256915B');
        $this->addSql('DROP INDEX IDX_BDADBC463256915B ON temoignage');
        $this->addSql('ALTER TABLE temoignage DROP relation_id');
    }
}
