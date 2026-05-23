<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260521174228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes ADD descubierto TINYINT NOT NULL, ADD especializaci√on_id INT DEFAULT NULL, ADD estadisticas_id INT DEFAULT NULL, ADD estado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jefes ADD CONSTRAINT FK_84849736BFEE271 FOREIGN KEY (especializaci√on_id) REFERENCES especializacion (id)');
        $this->addSql('ALTER TABLE jefes ADD CONSTRAINT FK_84849736183CB71 FOREIGN KEY (estadisticas_id) REFERENCES estadisticas (id)');
        $this->addSql('ALTER TABLE jefes ADD CONSTRAINT FK_848497369F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_84849736BFEE271 ON jefes (especializaci√on_id)');
        $this->addSql('CREATE INDEX IDX_84849736183CB71 ON jefes (estadisticas_id)');
        $this->addSql('CREATE INDEX IDX_848497369F5A440B ON jefes (estado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes DROP FOREIGN KEY FK_84849736BFEE271');
        $this->addSql('ALTER TABLE jefes DROP FOREIGN KEY FK_84849736183CB71');
        $this->addSql('ALTER TABLE jefes DROP FOREIGN KEY FK_848497369F5A440B');
        $this->addSql('DROP INDEX IDX_84849736BFEE271 ON jefes');
        $this->addSql('DROP INDEX IDX_84849736183CB71 ON jefes');
        $this->addSql('DROP INDEX IDX_848497369F5A440B ON jefes');
        $this->addSql('ALTER TABLE jefes DROP descubierto, DROP especializaci√on_id, DROP estadisticas_id, DROP estado_id');
    }
}
