<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260526125640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cambio seguro de relación 1:N a N:N entre Recursos y Especializacion';
    }

    public function up(Schema $schema): void
    {
        // 1. Crear la tabla intermedia con sus claves foráneas
        $this->addSql('CREATE TABLE especializacion_recurso (especializacion_id INT NOT NULL, recursos_id INT NOT NULL, INDEX IDX_6C898495AD5E55 (especializacion_id), INDEX IDX_6C89849561E8A749 (recursos_id), PRIMARY KEY(especializacion_id, recursos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE especializacion_recurso ADD CONSTRAINT FK_6C898495AD5E55 FOREIGN KEY (especializacion_id) REFERENCES especializacion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE especializacion_recurso ADD CONSTRAINT FK_6C89849561E8A749 FOREIGN KEY (recursos_id) REFERENCES recursos (id) ON DELETE CASCADE');
    
        // 2. Migrar los datos existentes a la nueva tabla intermedia antes de borrar nada
        $this->addSql('INSERT INTO especializacion_recurso (especializacion_id, recursos_id) SELECT id, recurso_id FROM especializacion WHERE recurso_id IS NOT NULL');
    
        // 3. Eliminar la Foreign Key real, su índice y la columna antigua
        $this->addSql('ALTER TABLE especializacion DROP FOREIGN KEY especializacion_ibfk_1'); 
        $this->addSql('DROP INDEX IDX_24C61C04E52B6C4E ON especializacion');
        $this->addSql('ALTER TABLE especializacion DROP recurso_id');
    }

    public function down(Schema $schema): void
    {
        // 1. Volver a crear la columna original como NULL provisionalmente
        $this->addSql('ALTER TABLE especializacion ADD recurso_id INT DEFAULT NULL');

        // 2. Revertir los datos de la tabla intermedia a la columna original (rescata el 1:N)
        $this->addSql('UPDATE especializacion e SET e.recurso_id = (SELECT er.recursos_id FROM especializacion_recurso er WHERE er.especializacion_id = e.id LIMIT 1)');

        // 3. Volver a hacer la columna NOT NULL como estaba originalmente
        $this->addSql('ALTER TABLE especializacion MODIFY recurso_id INT NOT NULL');

        // 4. Reconstruir el índice y la FK original con su nombre exacto
        $this->addSql('CREATE INDEX IDX_24C61C04E52B6C4E ON especializacion (recurso_id)');
        $this->addSql('ALTER TABLE especializacion ADD CONSTRAINT especializacion_ibfk_1 FOREIGN KEY (recurso_id) REFERENCES recursos (id) ON DELETE RESTRICT ON UPDATE RESTRICT');

        // 5. Eliminar de forma limpia la tabla intermedia
        $this->addSql('ALTER TABLE especializacion_recurso DROP FOREIGN KEY FK_6C898495AD5E55');
        $this->addSql('ALTER TABLE especializacion_recurso DROP FOREIGN KEY FK_6C89849561E8A749');
        $this->addSql('DROP TABLE especializacion_recurso');
    }
}