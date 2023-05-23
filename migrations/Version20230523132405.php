<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523132405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations CHANGE jour jour DATETIME NOT NULL, CHANGE heure_dej heure_dej VARCHAR(255) DEFAULT NULL, CHANGE heure_diner heure_diner VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations CHANGE jour jour DATETIME DEFAULT NULL, CHANGE heure_dej heure_dej TIME DEFAULT NULL, CHANGE heure_diner heure_diner TIME DEFAULT NULL');
    }
}
