<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428000352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE office');
        $this->addSql('ALTER TABLE ac ADD craft_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBE836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('CREATE INDEX IDX_E98478FBE836CCC8 ON ac (craft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE office (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FBE836CCC8');
        $this->addSql('DROP INDEX IDX_E98478FBE836CCC8 ON ac');
        $this->addSql('ALTER TABLE ac DROP craft_id');
    }
}
