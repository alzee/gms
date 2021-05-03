<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503230153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gac ADD clerk_id INT NOT NULL');
        $this->addSql('ALTER TABLE gac ADD CONSTRAINT FK_1A846EB3D95C1FC6 FOREIGN KEY (clerk_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1A846EB3D95C1FC6 ON gac (clerk_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gac DROP FOREIGN KEY FK_1A846EB3D95C1FC6');
        $this->addSql('DROP INDEX IDX_1A846EB3D95C1FC6 ON gac');
        $this->addSql('ALTER TABLE gac DROP clerk_id');
    }
}
