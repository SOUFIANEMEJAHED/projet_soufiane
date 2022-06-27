<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420234438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER DEFAULT NULL, categorie_id INTEGER NOT NULL, titre VARCHAR(255) DEFAULT NULL, contenu CLOB DEFAULT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_23A0E66FB88E14F ON article (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
        $this->addSql('CREATE TABLE article_motscles (article_id INTEGER NOT NULL, motscles_id INTEGER NOT NULL, PRIMARY KEY(article_id, motscles_id))');
        $this->addSql('CREATE INDEX IDX_91C3A2617294869C ON article_motscles (article_id)');
        $this->addSql('CREATE INDEX IDX_91C3A2612B8B43B0 ON article_motscles (motscles_id)');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie VARCHAR(250) NOT NULL)');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL, id_user INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        $this->addSql('CREATE TABLE motscles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, motcle VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nomprenom VARCHAR(200) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_motscles');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE motscles');
        $this->addSql('DROP TABLE utilisateur');
    }
}
