<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260524204656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta_comercial ADD npc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oferta_comercial ADD CONSTRAINT FK_1C13E606CA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id)');
        $this->addSql('CREATE INDEX IDX_1C13E606CA7D6B89 ON oferta_comercial (npc_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta_comercial DROP FOREIGN KEY FK_1C13E606CA7D6B89');
        $this->addSql('DROP INDEX IDX_1C13E606CA7D6B89 ON oferta_comercial');
        $this->addSql('ALTER TABLE oferta_comercial DROP npc_id');
    }
}
