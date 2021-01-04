<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104093849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, livre_id INT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date DATE NOT NULL, INDEX IDX_67F068BC37D925CB (livre_id), INDEX IDX_67F068BCFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_de_lecture (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_liste VARCHAR(255) NOT NULL, INDEX IDX_EF95D25DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, saga_id INT NOT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, nombre_page INT NOT NULL, INDEX IDX_AC634F99B2CCEE2E (saga_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saga (id INT AUTO_INCREMENT NOT NULL, nom_saga VARCHAR(255) NOT NULL, volume INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE liste_de_lecture ADD CONSTRAINT FK_EF95D25DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99B2CCEE2E FOREIGN KEY (saga_id) REFERENCES saga (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC37D925CB');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99B2CCEE2E');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE liste_de_lecture');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE saga');
    }
}
