<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504081549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FBA0321766');
        $this->addSql('DROP INDEX IDX_E98478FBA0321766 ON ac');
        $this->addSql('ALTER TABLE ac CHANGE maindoc_id child_id INT NOT NULL');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBDD62C21B FOREIGN KEY (child_id) REFERENCES child (id)');
        $this->addSql('CREATE INDEX IDX_E98478FBDD62C21B ON ac (child_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FBDD62C21B');
        $this->addSql('DROP INDEX IDX_E98478FBDD62C21B ON ac');
        $this->addSql('ALTER TABLE ac CHANGE child_id maindoc_id INT NOT NULL');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBA0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('CREATE INDEX IDX_E98478FBA0321766 ON ac (maindoc_id)');
    }
}
