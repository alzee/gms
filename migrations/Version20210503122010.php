<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503122010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483AD95C1FC6');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AD95C1FC6 FOREIGN KEY (clerk_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cc ADD sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cc ADD CONSTRAINT FK_DBB21A79F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DBB21A79F624B39D ON cc (sender_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483AD95C1FC6');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AD95C1FC6 FOREIGN KEY (clerk_id) REFERENCES clerk (id)');
        $this->addSql('ALTER TABLE cc DROP FOREIGN KEY FK_DBB21A79F624B39D');
        $this->addSql('DROP INDEX IDX_DBB21A79F624B39D ON cc');
        $this->addSql('ALTER TABLE cc DROP sender_id');
    }
}
