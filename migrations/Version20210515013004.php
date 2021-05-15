<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515013004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD647975B7E7');
        $this->addSql('DROP INDEX IDX_BF28CD647975B7E7 ON main');
        $this->addSql('ALTER TABLE main DROP model_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD647975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_BF28CD647975B7E7 ON main (model_id)');
    }
}
