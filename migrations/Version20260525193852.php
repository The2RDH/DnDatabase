<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260525193852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE npc ADD lugar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CB5A3803B FOREIGN KEY (lugar_id) REFERENCES lugares (id)');
        $this->addSql('CREATE INDEX IDX_468C762CB5A3803B ON npc (lugar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CB5A3803B');
        $this->addSql('DROP INDEX IDX_468C762CB5A3803B ON npc');
        $this->addSql('ALTER TABLE npc DROP lugar_id');
    }
}
