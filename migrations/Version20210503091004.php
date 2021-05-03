<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503091004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd ADD child_id INT NOT NULL');
        $this->addSql('ALTER TABLE cgd ADD CONSTRAINT FK_D5B3F44ADD62C21B FOREIGN KEY (child_id) REFERENCES child (id)');
        $this->addSql('CREATE INDEX IDX_D5B3F44ADD62C21B ON cgd (child_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cgd DROP FOREIGN KEY FK_D5B3F44ADD62C21B');
        $this->addSql('DROP INDEX IDX_D5B3F44ADD62C21B ON cgd');
        $this->addSql('ALTER TABLE cgd DROP child_id');
    }
}
