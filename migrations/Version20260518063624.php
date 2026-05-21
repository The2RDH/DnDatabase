<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518063624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barajas ADD baraja VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE clases ADD recurso_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clases ADD CONSTRAINT FK_67CBBF10E52B6C4E FOREIGN KEY (recurso_id) REFERENCES recursos (id)');
        $this->addSql('CREATE INDEX IDX_67CBBF10E52B6C4E ON clases (recurso_id)');
        $this->addSql('ALTER TABLE especializacion RENAME INDEX recurso_id TO IDX_24C61C04E52B6C4E');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barajas DROP baraja');
        $this->addSql('ALTER TABLE clases DROP FOREIGN KEY FK_67CBBF10E52B6C4E');
        $this->addSql('DROP INDEX IDX_67CBBF10E52B6C4E ON clases');
        $this->addSql('ALTER TABLE clases DROP recurso_id');
        $this->addSql('ALTER TABLE especializacion RENAME INDEX idx_24c61c04e52b6c4e TO recurso_id');
    }
}
