<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516214335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca ADD goldclass_id INT DEFAULT NULL, ADD team_id INT DEFAULT NULL, ADD model VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55A145C139 ON ca (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55296CD8AE ON ca (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55A145C139');
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55296CD8AE');
        $this->addSql('DROP INDEX IDX_35BC7B55A145C139 ON ca');
        $this->addSql('DROP INDEX IDX_35BC7B55296CD8AE ON ca');
        $this->addSql('ALTER TABLE ca DROP goldclass_id, DROP team_id, DROP model');
    }
}
