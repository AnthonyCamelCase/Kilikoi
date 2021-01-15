<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115083920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC37D925CB');
        $this->addSql('ALTER TABLE commentaire CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE liste_de_lecture DROP FOREIGN KEY FK_EF95D25DFB88E14F');
        $this->addSql('ALTER TABLE liste_de_lecture ADD CONSTRAINT FK_EF95D25DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99B2CCEE2E');
        $this->addSql('ALTER TABLE livre CHANGE saga_id saga_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99B2CCEE2E FOREIGN KEY (saga_id) REFERENCES saga (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC37D925CB');
        $this->addSql('ALTER TABLE commentaire CHANGE date date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_de_lecture DROP FOREIGN KEY FK_EF95D25DFB88E14F');
        $this->addSql('ALTER TABLE liste_de_lecture ADD CONSTRAINT FK_EF95D25DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99B2CCEE2E');
        $this->addSql('ALTER TABLE livre CHANGE saga_id saga_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99B2CCEE2E FOREIGN KEY (saga_id) REFERENCES saga (id) ON DELETE CASCADE');
    }
}
