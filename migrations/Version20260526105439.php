<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260526105439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes ADD golpe_gracia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jefes ADD CONSTRAINT FK_84849736F654AE72 FOREIGN KEY (golpe_gracia_id) REFERENCES personaje (id)');
        $this->addSql('CREATE INDEX IDX_84849736F654AE72 ON jefes (golpe_gracia_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jefes DROP FOREIGN KEY FK_84849736F654AE72');
        $this->addSql('DROP INDEX IDX_84849736F654AE72 ON jefes');
        $this->addSql('ALTER TABLE jefes DROP golpe_gracia_id');
    }
}
