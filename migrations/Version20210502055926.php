<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502055926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child ADD goldclass_id INT NOT NULL, ADD main_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL, ADD note VARCHAR(255) DEFAULT NULL, ADD sn VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429627EA78A FOREIGN KEY (main_id) REFERENCES main (id)');
        $this->addSql('CREATE INDEX IDX_22B35429A145C139 ON child (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_22B35429627EA78A ON child (main_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429A145C139');
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429627EA78A');
        $this->addSql('DROP INDEX IDX_22B35429A145C139 ON child');
        $this->addSql('DROP INDEX IDX_22B35429627EA78A ON child');
        $this->addSql('ALTER TABLE child DROP goldclass_id, DROP main_id, DROP weight, DROP note, DROP sn');
    }
}
