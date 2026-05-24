<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260524202532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lore_personaje (lore_id INT NOT NULL, personaje_id INT NOT NULL, INDEX IDX_4A50945A3E32ECDC (lore_id), INDEX IDX_4A50945A121EFAFB (personaje_id), PRIMARY KEY (lore_id, personaje_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE lore_personaje ADD CONSTRAINT FK_4A50945A3E32ECDC FOREIGN KEY (lore_id) REFERENCES lore (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lore_personaje ADD CONSTRAINT FK_4A50945A121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX IDX_24C61C041E7069D7 ON especializacion');
        $this->addSql('ALTER TABLE especializacion DROP dados_descanso_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lore_personaje DROP FOREIGN KEY FK_4A50945A3E32ECDC');
        $this->addSql('ALTER TABLE lore_personaje DROP FOREIGN KEY FK_4A50945A121EFAFB');
        $this->addSql('DROP TABLE lore_personaje');
        $this->addSql('ALTER TABLE especializacion ADD dados_descanso_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_24C61C041E7069D7 ON especializacion (dados_descanso_id)');
    }
}
