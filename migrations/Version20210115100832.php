<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115100832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `liste_de_lecture` DROP FOREIGN KEY `FK_EF95D25DFB88E14F`; ALTER TABLE `liste_de_lecture` ADD CONSTRAINT `FK_EF95D25DFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT');
        $this->addSql('ALTER TABLE `commentaire` DROP FOREIGN KEY `FK_67F068BCFB88E14F`; ALTER TABLE `commentaire` ADD CONSTRAINT `FK_67F068BCFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT');
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE utilisateur_id utilisateur_id INT NOT NULL');
    }
}
