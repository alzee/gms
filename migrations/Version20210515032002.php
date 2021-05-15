<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515032002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lossrate ADD craft_id INT DEFAULT NULL, ADD name VARCHAR(15) DEFAULT NULL, ADD model VARCHAR(255) DEFAULT NULL, ADD note VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lossrate ADD CONSTRAINT FK_52F453C4E836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('CREATE INDEX IDX_52F453C4E836CCC8 ON lossrate (craft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lossrate DROP FOREIGN KEY FK_52F453C4E836CCC8');
        $this->addSql('DROP INDEX IDX_52F453C4E836CCC8 ON lossrate');
        $this->addSql('ALTER TABLE lossrate DROP craft_id, DROP name, DROP model, DROP note');
    }
}
