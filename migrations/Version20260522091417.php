<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522091417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enemigos ADD estadisticas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enemigos ADD CONSTRAINT FK_3FE459D9183CB71 FOREIGN KEY (estadisticas_id) REFERENCES estadisticas (id)');
        $this->addSql('CREATE INDEX IDX_3FE459D9183CB71 ON enemigos (estadisticas_id)');
        $this->addSql('ALTER TABLE npc ADD estadisticas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C183CB71 FOREIGN KEY (estadisticas_id) REFERENCES estadisticas (id)');
        $this->addSql('CREATE INDEX IDX_468C762C183CB71 ON npc (estadisticas_id)');
        $this->addSql('ALTER TABLE personaje ADD estadisticas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088183CB71 FOREIGN KEY (estadisticas_id) REFERENCES estadisticas (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_53A41088183CB71 ON personaje (estadisticas_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enemigos DROP FOREIGN KEY FK_3FE459D9183CB71');
        $this->addSql('DROP INDEX IDX_3FE459D9183CB71 ON enemigos');
        $this->addSql('ALTER TABLE enemigos DROP estadisticas_id');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C183CB71');
        $this->addSql('DROP INDEX IDX_468C762C183CB71 ON npc');
        $this->addSql('ALTER TABLE npc DROP estadisticas_id');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088183CB71');
        $this->addSql('DROP INDEX UNIQ_53A41088183CB71 ON personaje');
        $this->addSql('ALTER TABLE personaje DROP estadisticas_id');
    }
}
