<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522084105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barajas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE cartas_baraja ADD baraja_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cartas_baraja ADD CONSTRAINT FK_26E66F20F99AE3FC FOREIGN KEY (baraja_id) REFERENCES barajas (id)');
        $this->addSql('CREATE INDEX IDX_26E66F20F99AE3FC ON cartas_baraja (baraja_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE barajas');
        $this->addSql('ALTER TABLE cartas_baraja DROP FOREIGN KEY FK_26E66F20F99AE3FC');
        $this->addSql('DROP INDEX IDX_26E66F20F99AE3FC ON cartas_baraja');
        $this->addSql('ALTER TABLE cartas_baraja DROP baraja_id');
    }
}
