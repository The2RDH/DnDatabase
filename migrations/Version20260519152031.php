<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260519152031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE npc (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, altura VARCHAR(255) DEFAULT NULL, peso VARCHAR(255) DEFAULT NULL, nivel INT DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, raza_id INT DEFAULT NULL, clase_id INT DEFAULT NULL, especializacion_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, INDEX IDX_468C762C8CCBB6A9 (raza_id), INDEX IDX_468C762C9F720353 (clase_id), INDEX IDX_468C762CF5385710 (especializacion_id), INDEX IDX_468C762C9F5A440B (estado_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE personaje (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) DEFAULT NULL, altura VARCHAR(255) DEFAULT NULL, peso VARCHAR(255) DEFAULT NULL, edad VARCHAR(255) DEFAULT NULL, originario VARCHAR(255) DEFAULT NULL, nivel INT DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, alineamiento_id INT DEFAULT NULL, raza_id INT DEFAULT NULL, clase_id INT DEFAULT NULL, jugador_id INT DEFAULT NULL, INDEX IDX_53A41088A272D40F (alineamiento_id), INDEX IDX_53A410888CCBB6A9 (raza_id), INDEX IDX_53A410889F720353 (clase_id), INDEX IDX_53A41088B8A54D43 (jugador_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE personaje_idiomas (personaje_id INT NOT NULL, idiomas_id INT NOT NULL, INDEX IDX_7CD34E41121EFAFB (personaje_id), INDEX IDX_7CD34E418D1F41D1 (idiomas_id), PRIMARY KEY (personaje_id, idiomas_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES razas (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C9F720353 FOREIGN KEY (clase_id) REFERENCES clases (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CF5385710 FOREIGN KEY (especializacion_id) REFERENCES especializacion (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088A272D40F FOREIGN KEY (alineamiento_id) REFERENCES alineamiento (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410888CCBB6A9 FOREIGN KEY (raza_id) REFERENCES razas (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410889F720353 FOREIGN KEY (clase_id) REFERENCES clases (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088B8A54D43 FOREIGN KEY (jugador_id) REFERENCES jugadores (id)');
        $this->addSql('ALTER TABLE personaje_idiomas ADD CONSTRAINT FK_7CD34E41121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personaje_idiomas ADD CONSTRAINT FK_7CD34E418D1F41D1 FOREIGN KEY (idiomas_id) REFERENCES idiomas (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_4CD27885121EFAFB ON arbol_personajes');
        $this->addSql('ALTER TABLE arbol_personajes DROP personaje_id');
        $this->addSql('ALTER TABLE hechizos ADD duracion VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_6A194EF5121EFAFB ON inventario');
        $this->addSql('ALTER TABLE inventario DROP personaje_id');
        $this->addSql('ALTER TABLE inventario ADD CONSTRAINT FK_6A194EF576F5CD27 FOREIGN KEY (objeto_id) REFERENCES objetos (id)');
        $this->addSql('DROP INDEX IDX_33EE951910DAF24A ON lore');
        $this->addSql('ALTER TABLE lore DROP actor_id');
        $this->addSql('DROP INDEX IDX_1C13E606CA7D6B89 ON oferta_comercial');
        $this->addSql('ALTER TABLE oferta_comercial DROP npc_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C8CCBB6A9');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C9F720353');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CF5385710');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C9F5A440B');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088A272D40F');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410888CCBB6A9');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410889F720353');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088B8A54D43');
        $this->addSql('ALTER TABLE personaje_idiomas DROP FOREIGN KEY FK_7CD34E41121EFAFB');
        $this->addSql('ALTER TABLE personaje_idiomas DROP FOREIGN KEY FK_7CD34E418D1F41D1');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE personaje');
        $this->addSql('DROP TABLE personaje_idiomas');
        $this->addSql('ALTER TABLE arbol_personajes ADD personaje_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CD27885121EFAFB ON arbol_personajes (personaje_id)');
        $this->addSql('ALTER TABLE hechizos DROP duracion');
        $this->addSql('ALTER TABLE inventario DROP FOREIGN KEY FK_6A194EF576F5CD27');
        $this->addSql('ALTER TABLE inventario ADD personaje_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_6A194EF5121EFAFB ON inventario (personaje_id)');
        $this->addSql('ALTER TABLE lore ADD actor_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_33EE951910DAF24A ON lore (actor_id)');
        $this->addSql('ALTER TABLE oferta_comercial ADD npc_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_1C13E606CA7D6B89 ON oferta_comercial (npc_id)');
    }
}
