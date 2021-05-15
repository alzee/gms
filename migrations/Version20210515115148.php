<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515115148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca ADD main_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55627EA78A FOREIGN KEY (main_id) REFERENCES main (id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55627EA78A ON ca (main_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55627EA78A');
        $this->addSql('DROP INDEX IDX_35BC7B55627EA78A ON ca');
        $this->addSql('ALTER TABLE ca DROP main_id');
    }
}
