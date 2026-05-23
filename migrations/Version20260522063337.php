<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522063337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arbol_personajes ADD personaje_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE arbol_personajes ADD CONSTRAINT FK_4CD27885121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CD27885121EFAFB ON arbol_personajes (personaje_id)');
        $this->addSql('ALTER TABLE jefes RENAME INDEX idx_84849736bfee271 TO IDX_84849736F5385710');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arbol_personajes DROP FOREIGN KEY FK_4CD27885121EFAFB');
        $this->addSql('DROP INDEX UNIQ_4CD27885121EFAFB ON arbol_personajes');
        $this->addSql('ALTER TABLE arbol_personajes DROP personaje_id');
        $this->addSql('ALTER TABLE jefes RENAME INDEX idx_84849736f5385710 TO IDX_84849736BFEE271');
    }
}
