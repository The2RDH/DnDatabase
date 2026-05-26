<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260526164556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE especializacion_recurso RENAME INDEX idx_6c898495ad5e55 TO IDX_11375A34F5385710');
        $this->addSql('ALTER TABLE especializacion_recurso RENAME INDEX idx_6c89849561e8a749 TO IDX_11375A3476F0FADE');
        $this->addSql('ALTER TABLE personaje ADD especializacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088F5385710 FOREIGN KEY (especializacion_id) REFERENCES especializacion (id)');
        $this->addSql('CREATE INDEX IDX_53A41088F5385710 ON personaje (especializacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE especializacion_recurso RENAME INDEX idx_11375a3476f0fade TO IDX_6C89849561E8A749');
        $this->addSql('ALTER TABLE especializacion_recurso RENAME INDEX idx_11375a34f5385710 TO IDX_6C898495AD5E55');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088F5385710');
        $this->addSql('DROP INDEX IDX_53A41088F5385710 ON personaje');
        $this->addSql('ALTER TABLE personaje DROP especializacion_id');
    }
}
