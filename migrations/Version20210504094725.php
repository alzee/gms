<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504094725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55D95C1FC6');
        $this->addSql('ALTER TABLE ca ADD status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55D95C1FC6 FOREIGN KEY (clerk_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B55D95C1FC6');
        $this->addSql('ALTER TABLE ca DROP status');
        $this->addSql('ALTER TABLE ca ADD CONSTRAINT FK_35BC7B55D95C1FC6 FOREIGN KEY (clerk_id) REFERENCES clerk (id)');
    }
}
