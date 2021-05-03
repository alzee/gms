<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503105903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79E92F8F78');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(15) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79E92F8F78');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79E92F8F78 FOREIGN KEY (recipient_id) REFERENCES clerk (id)');
        $this->addSql('ALTER TABLE user DROP name');
    }
}
