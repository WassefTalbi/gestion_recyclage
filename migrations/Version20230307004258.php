<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307004258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalisation ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE signalisation ADD CONSTRAINT FK_1BD243CDBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BD243CDBE6CAE90 ON signalisation (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalisation DROP FOREIGN KEY FK_1BD243CDBE6CAE90');
        $this->addSql('DROP INDEX UNIQ_1BD243CDBE6CAE90 ON signalisation');
        $this->addSql('ALTER TABLE signalisation DROP mission_id');
    }
}
