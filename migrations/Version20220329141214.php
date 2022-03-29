<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329141214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_article INTEGER NOT NULL, id_categorie INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE avoir (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_artcile INTEGER NOT NULL, id_mot_cle INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE motscles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, motcle VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appartient');
        $this->addSql('DROP TABLE avoir');
        $this->addSql('DROP TABLE motscles');
    }
}
