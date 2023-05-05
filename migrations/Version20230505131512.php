<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505131512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE imagenes (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(500) NOT NULL, texto VARCHAR(30) NOT NULL, alto INT NOT NULL, ancho INT NOT NULL, colores TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, mail VARCHAR(50) NOT NULL, password VARCHAR(20) NOT NULL, imagen VARCHAR(1000) DEFAULT \'NULL\', colores TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE imagenes');
        $this->addSql('DROP TABLE users');
    }
}
