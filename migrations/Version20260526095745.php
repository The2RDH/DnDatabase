<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260526095745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes ADD descripcion LONGTEXT DEFAULT NULL, ADD lore LONGTEXT DEFAULT NULL, ADD edad VARCHAR(255) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD imagen VARCHAR(255) DEFAULT NULL, ADD altura VARCHAR(255) DEFAULT NULL, ADD peso VARCHAR(255) DEFAULT NULL, ADD debilidades LONGTEXT DEFAULT NULL, ADD fortalezas LONGTEXT DEFAULT NULL, ADD alineamiento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jefes ADD CONSTRAINT FK_84849736A272D40F FOREIGN KEY (alineamiento_id) REFERENCES alineamiento (id)');
        $this->addSql('CREATE INDEX IDX_84849736A272D40F ON jefes (alineamiento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes DROP FOREIGN KEY FK_84849736A272D40F');
        $this->addSql('DROP INDEX IDX_84849736A272D40F ON jefes');
        $this->addSql('ALTER TABLE jefes DROP descripcion, DROP lore, DROP edad, DROP token, DROP imagen, DROP altura, DROP peso, DROP debilidades, DROP fortalezas, DROP alineamiento_id');
    }
}
