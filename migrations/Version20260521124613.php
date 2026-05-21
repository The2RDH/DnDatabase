<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260521124613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enemigos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, imagen VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, descubierto TINYINT NOT NULL, nivel VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, clase_id INT NOT NULL, especializacion_id INT DEFAULT NULL, INDEX IDX_3FE459D99F720353 (clase_id), INDEX IDX_3FE459D9F5385710 (especializacion_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enemigos_tipo_enemigos (enemigos_id INT NOT NULL, tipo_enemigos_id INT NOT NULL, INDEX IDX_324122D528070BCC (enemigos_id), INDEX IDX_324122D51D232534 (tipo_enemigos_id), PRIMARY KEY (enemigos_id, tipo_enemigos_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enemigos_grupo_enemigos (enemigos_id INT NOT NULL, grupo_enemigos_id INT NOT NULL, INDEX IDX_9CDC300228070BCC (enemigos_id), INDEX IDX_9CDC30023906EBD6 (grupo_enemigos_id), PRIMARY KEY (enemigos_id, grupo_enemigos_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enemigos_razas (enemigos_id INT NOT NULL, razas_id INT NOT NULL, INDEX IDX_D6063B3128070BCC (enemigos_id), INDEX IDX_D6063B3148F76DDF (razas_id), PRIMARY KEY (enemigos_id, razas_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE enemigos ADD CONSTRAINT FK_3FE459D99F720353 FOREIGN KEY (clase_id) REFERENCES clases (id)');
        $this->addSql('ALTER TABLE enemigos ADD CONSTRAINT FK_3FE459D9F5385710 FOREIGN KEY (especializacion_id) REFERENCES especializacion (id)');
        $this->addSql('ALTER TABLE enemigos_tipo_enemigos ADD CONSTRAINT FK_324122D528070BCC FOREIGN KEY (enemigos_id) REFERENCES enemigos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enemigos_tipo_enemigos ADD CONSTRAINT FK_324122D51D232534 FOREIGN KEY (tipo_enemigos_id) REFERENCES tipo_enemigos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enemigos_grupo_enemigos ADD CONSTRAINT FK_9CDC300228070BCC FOREIGN KEY (enemigos_id) REFERENCES enemigos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enemigos_grupo_enemigos ADD CONSTRAINT FK_9CDC30023906EBD6 FOREIGN KEY (grupo_enemigos_id) REFERENCES grupo_enemigos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enemigos_razas ADD CONSTRAINT FK_D6063B3128070BCC FOREIGN KEY (enemigos_id) REFERENCES enemigos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enemigos_razas ADD CONSTRAINT FK_D6063B3148F76DDF FOREIGN KEY (razas_id) REFERENCES razas (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enemigos DROP FOREIGN KEY FK_3FE459D99F720353');
        $this->addSql('ALTER TABLE enemigos DROP FOREIGN KEY FK_3FE459D9F5385710');
        $this->addSql('ALTER TABLE enemigos_tipo_enemigos DROP FOREIGN KEY FK_324122D528070BCC');
        $this->addSql('ALTER TABLE enemigos_tipo_enemigos DROP FOREIGN KEY FK_324122D51D232534');
        $this->addSql('ALTER TABLE enemigos_grupo_enemigos DROP FOREIGN KEY FK_9CDC300228070BCC');
        $this->addSql('ALTER TABLE enemigos_grupo_enemigos DROP FOREIGN KEY FK_9CDC30023906EBD6');
        $this->addSql('ALTER TABLE enemigos_razas DROP FOREIGN KEY FK_D6063B3128070BCC');
        $this->addSql('ALTER TABLE enemigos_razas DROP FOREIGN KEY FK_D6063B3148F76DDF');
        $this->addSql('DROP TABLE enemigos');
        $this->addSql('DROP TABLE enemigos_tipo_enemigos');
        $this->addSql('DROP TABLE enemigos_grupo_enemigos');
        $this->addSql('DROP TABLE enemigos_razas');
    }
}
