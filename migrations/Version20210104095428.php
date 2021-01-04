<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104095428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste_de_lecture_livre (liste_de_lecture_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_4D5E121E314EB86A (liste_de_lecture_id), INDEX IDX_4D5E121E37D925CB (livre_id), PRIMARY KEY(liste_de_lecture_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_liste (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_de_lecture_livre ADD CONSTRAINT FK_4D5E121E314EB86A FOREIGN KEY (liste_de_lecture_id) REFERENCES liste_de_lecture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_de_lecture_livre ADD CONSTRAINT FK_4D5E121E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liste_de_lecture_livre');
        $this->addSql('DROP TABLE livre_liste');
    }
}
