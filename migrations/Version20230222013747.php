<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222013747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalisation ADD ville VARCHAR(255) NOT NULL, ADD region VARCHAR(255) NOT NULL, ADD rue VARCHAR(255) NOT NULL, ADD lat NUMERIC(25, 25) NOT NULL, ADD lon NUMERIC(25, 25) NOT NULL, DROP adresse_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalisation ADD adresse_id INT DEFAULT NULL, DROP ville, DROP region, DROP rue, DROP lat, DROP lon');
    }
}
