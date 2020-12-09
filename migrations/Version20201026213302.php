<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026213302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proprity ADD name VARCHAR(255) NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD location VARCHAR(255) NOT NULL, ADD solde TINYINT(1) NOT NULL, ADD date_mise_circul DATE DEFAULT NULL, ADD marque VARCHAR(255) DEFAULT NULL, ADD puissance INT DEFAULT NULL, ADD tranmission VARCHAR(255) NOT NULL, ADD compteur VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proprity DROP name, DROP price, DROP location, DROP solde, DROP date_mise_circul, DROP marque, DROP puissance, DROP tranmission, DROP compteur');
    }
}
