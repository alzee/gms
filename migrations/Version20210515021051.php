<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515021051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD craft_id INT DEFAULT NULL, ADD weight_attach DOUBLE PRECISION DEFAULT NULL, ADD size DOUBLE PRECISION DEFAULT NULL, ADD model VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429E836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('CREATE INDEX IDX_22B35429E836CCC8 ON child (craft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429E836CCC8');
        $this->addSql('DROP INDEX IDX_22B35429E836CCC8 ON child');
        $this->addSql('ALTER TABLE child DROP craft_id, DROP weight_attach, DROP size, DROP model');
    }
}
