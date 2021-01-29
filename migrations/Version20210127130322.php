<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127130322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalogue DROP user, CHANGE icon icon VARCHAR(255) NOT NULL, CHANGE nb_produit nb_produit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD catalogue_id INT DEFAULT NULL, DROP catalogue');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC274A7843DC ON produit (catalogue_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalogue ADD user VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nb_produit nb_produit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274A7843DC');
        $this->addSql('DROP INDEX IDX_29A5EC274A7843DC ON produit');
        $this->addSql('ALTER TABLE produit ADD catalogue VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP catalogue_id');
    }
}
