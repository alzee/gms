<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504080506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55A0321766');
        $this->addSql('DROP INDEX IDX_35BC7B55A0321766 ON ca');
        $this->addSql('ALTER TABLE ca CHANGE maindoc_id child_id INT NOT NULL');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55DD62C21B FOREIGN KEY (child_id) REFERENCES child (id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55DD62C21B ON ca (child_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55DD62C21B');
        $this->addSql('DROP INDEX IDX_35BC7B55DD62C21B ON ca');
        $this->addSql('ALTER TABLE ca CHANGE child_id maindoc_id INT NOT NULL');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55A0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('CREATE INDEX IDX_35BC7B55A0321766 ON ca (maindoc_id)');
    }
}
