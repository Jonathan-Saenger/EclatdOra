<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241214215830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Mise à jour de l\'entité Evènement';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD adresse VARCHAR(255) DEFAULT NULL, ADD codepostal VARCHAR(255) DEFAULT NULL, ADD place INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP adresse, DROP codepostal, DROP place');
    }
}
