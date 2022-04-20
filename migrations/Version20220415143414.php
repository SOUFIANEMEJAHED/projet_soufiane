<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415143414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D');
        $this->addSql('DROP INDEX IDX_23A0E66FB88E14F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER DEFAULT NULL, categorie_id INTEGER NOT NULL, titre VARCHAR(255) DEFAULT NULL, contenu CLOB DEFAULT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME DEFAULT NULL, CONSTRAINT FK_23A0E66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif) SELECT id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FB88E14F ON article (utilisateur_id)');
        $this->addSql('DROP INDEX IDX_91C3A2612B8B43B0');
        $this->addSql('DROP INDEX IDX_91C3A2617294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_motscles AS SELECT article_id, motscles_id FROM article_motscles');
        $this->addSql('DROP TABLE article_motscles');
        $this->addSql('CREATE TABLE article_motscles (article_id INTEGER NOT NULL, motscles_id INTEGER NOT NULL, PRIMARY KEY(article_id, motscles_id), CONSTRAINT FK_91C3A2617294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_91C3A2612B8B43B0 FOREIGN KEY (motscles_id) REFERENCES motscles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article_motscles (article_id, motscles_id) SELECT article_id, motscles_id FROM __temp__article_motscles');
        $this->addSql('DROP TABLE __temp__article_motscles');
        $this->addSql('CREATE INDEX IDX_91C3A2612B8B43B0 ON article_motscles (motscles_id)');
        $this->addSql('CREATE INDEX IDX_91C3A2617294869C ON article_motscles (article_id)');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, article_id, contenu, date_creation, id_user FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL, id_user INTEGER NOT NULL, CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, article_id, contenu, date_creation, id_user) SELECT id, article_id, contenu, date_creation, id_user FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E66FB88E14F');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER DEFAULT NULL, categorie_id INTEGER DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, contenu CLOB DEFAULT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO article (id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif) SELECT id, utilisateur_id, categorie_id, titre, contenu, date_creation, date_modif FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E66FB88E14F ON article (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
        $this->addSql('DROP INDEX IDX_91C3A2617294869C');
        $this->addSql('DROP INDEX IDX_91C3A2612B8B43B0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_motscles AS SELECT article_id, motscles_id FROM article_motscles');
        $this->addSql('DROP TABLE article_motscles');
        $this->addSql('CREATE TABLE article_motscles (article_id INTEGER NOT NULL, motscles_id INTEGER NOT NULL, PRIMARY KEY(article_id, motscles_id))');
        $this->addSql('INSERT INTO article_motscles (article_id, motscles_id) SELECT article_id, motscles_id FROM __temp__article_motscles');
        $this->addSql('DROP TABLE __temp__article_motscles');
        $this->addSql('CREATE INDEX IDX_91C3A2617294869C ON article_motscles (article_id)');
        $this->addSql('CREATE INDEX IDX_91C3A2612B8B43B0 ON article_motscles (motscles_id)');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, article_id, contenu, date_creation, id_user FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER DEFAULT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL, id_user INTEGER NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, article_id, contenu, date_creation, id_user) SELECT id, article_id, contenu, date_creation, id_user FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
    }
}
