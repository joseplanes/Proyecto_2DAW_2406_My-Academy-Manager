<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240315194709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, INDEX IDX_1435D52D9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignatura (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, img LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aula (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, capacidad INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calificacion (id INT AUTO_INCREMENT NOT NULL, clase_id_id INT NOT NULL, alumno_id_id INT NOT NULL, nota INT NOT NULL, INDEX IDX_8A3AF2189D9D1695 (clase_id_id), INDEX IDX_8A3AF218D3819735 (alumno_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clase (id INT AUTO_INCREMENT NOT NULL, asignatura_id_id INT NOT NULL, profesor_id_id INT NOT NULL, aula_id_id INT NOT NULL, hora_inicio TIME NOT NULL, hora_fin TIME NOT NULL, INDEX IDX_199FACCEAF1D1CBB (asignatura_id_id), INDEX IDX_199FACCECBB93C16 (profesor_id_id), INDEX IDX_199FACCE89A0A06F (aula_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clase_alumno (clase_id INT NOT NULL, alumno_id INT NOT NULL, INDEX IDX_61BDAF399F720353 (clase_id), INDEX IDX_61BDAF39FC28E5EE (alumno_id), PRIMARY KEY(clase_id, alumno_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clase_dias_semana (clase_id INT NOT NULL, dias_semana_id INT NOT NULL, INDEX IDX_AB58496B9F720353 (clase_id), INDEX IDX_AB58496B15F0856E (dias_semana_id), PRIMARY KEY(clase_id, dias_semana_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dias_semana (id INT AUTO_INCREMENT NOT NULL, dia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, emisor_id_id INT NOT NULL, receptor_id_id INT NOT NULL, INDEX IDX_9B631D01823A769F (emisor_id_id), INDEX IDX_9B631D01DAAD54DC (receptor_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesa (id INT AUTO_INCREMENT NOT NULL, name INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profesor (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, INDEX IDX_5B7406D99D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, rol VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumno ADD CONSTRAINT FK_1435D52D9D86650F FOREIGN KEY (user_id_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE calificacion ADD CONSTRAINT FK_8A3AF2189D9D1695 FOREIGN KEY (clase_id_id) REFERENCES clase (id)');
        $this->addSql('ALTER TABLE calificacion ADD CONSTRAINT FK_8A3AF218D3819735 FOREIGN KEY (alumno_id_id) REFERENCES alumno (id)');
        $this->addSql('ALTER TABLE clase ADD CONSTRAINT FK_199FACCEAF1D1CBB FOREIGN KEY (asignatura_id_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE clase ADD CONSTRAINT FK_199FACCECBB93C16 FOREIGN KEY (profesor_id_id) REFERENCES profesor (id)');
        $this->addSql('ALTER TABLE clase ADD CONSTRAINT FK_199FACCE89A0A06F FOREIGN KEY (aula_id_id) REFERENCES aula (id)');
        $this->addSql('ALTER TABLE clase_alumno ADD CONSTRAINT FK_61BDAF399F720353 FOREIGN KEY (clase_id) REFERENCES clase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clase_alumno ADD CONSTRAINT FK_61BDAF39FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clase_dias_semana ADD CONSTRAINT FK_AB58496B9F720353 FOREIGN KEY (clase_id) REFERENCES clase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clase_dias_semana ADD CONSTRAINT FK_AB58496B15F0856E FOREIGN KEY (dias_semana_id) REFERENCES dias_semana (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01823A769F FOREIGN KEY (emisor_id_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01DAAD54DC FOREIGN KEY (receptor_id_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE profesor ADD CONSTRAINT FK_5B7406D99D86650F FOREIGN KEY (user_id_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumno DROP FOREIGN KEY FK_1435D52D9D86650F');
        $this->addSql('ALTER TABLE calificacion DROP FOREIGN KEY FK_8A3AF2189D9D1695');
        $this->addSql('ALTER TABLE calificacion DROP FOREIGN KEY FK_8A3AF218D3819735');
        $this->addSql('ALTER TABLE clase DROP FOREIGN KEY FK_199FACCEAF1D1CBB');
        $this->addSql('ALTER TABLE clase DROP FOREIGN KEY FK_199FACCECBB93C16');
        $this->addSql('ALTER TABLE clase DROP FOREIGN KEY FK_199FACCE89A0A06F');
        $this->addSql('ALTER TABLE clase_alumno DROP FOREIGN KEY FK_61BDAF399F720353');
        $this->addSql('ALTER TABLE clase_alumno DROP FOREIGN KEY FK_61BDAF39FC28E5EE');
        $this->addSql('ALTER TABLE clase_dias_semana DROP FOREIGN KEY FK_AB58496B9F720353');
        $this->addSql('ALTER TABLE clase_dias_semana DROP FOREIGN KEY FK_AB58496B15F0856E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01823A769F');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01DAAD54DC');
        $this->addSql('ALTER TABLE profesor DROP FOREIGN KEY FK_5B7406D99D86650F');
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE asignatura');
        $this->addSql('DROP TABLE aula');
        $this->addSql('DROP TABLE calificacion');
        $this->addSql('DROP TABLE clase');
        $this->addSql('DROP TABLE clase_alumno');
        $this->addSql('DROP TABLE clase_dias_semana');
        $this->addSql('DROP TABLE dias_semana');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE mesa');
        $this->addSql('DROP TABLE profesor');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
