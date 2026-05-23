<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522090204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventario ADD personaje_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF5121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id)');
        $this->addSql('CREATE INDEX IDX_6A194EF5121EFAFB ON inventario (personaje_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventario DROP FOREIGN KEY FK_6A194EF5121EFAFB');
        $this->addSql('DROP INDEX IDX_6A194EF5121EFAFB ON inventario');
        $this->addSql('ALTER TABLE inventario DROP personaje_id');
    }
}
