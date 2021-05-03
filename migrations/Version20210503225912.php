<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503225912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gca ADD clerk_id INT NOT NULL');
        $this->addSql('ALTER TABLE gca ADD CONSTRAINT FK_C6BC6D1DD95C1FC6 FOREIGN KEY (clerk_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C6BC6D1DD95C1FC6 ON gca (clerk_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gca DROP FOREIGN KEY FK_C6BC6D1DD95C1FC6');
        $this->addSql('DROP INDEX IDX_C6BC6D1DD95C1FC6 ON gca');
        $this->addSql('ALTER TABLE gca DROP clerk_id');
    }
}
