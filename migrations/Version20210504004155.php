<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504004155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gbs DROP FOREIGN KEY FK_2C1E2D144F91A684');
        $this->addSql('ALTER TABLE gbs DROP FOREIGN KEY FK_2C1E2D14D0A12A3C');
        $this->addSql('DROP INDEX IDX_2C1E2D144F91A684 ON gbs');
        $this->addSql('DROP INDEX IDX_2C1E2D14D0A12A3C ON gbs');
        $this->addSql('ALTER TABLE gbs ADD subtracttype_id INT NOT NULL, ADD subtractreason_id INT NOT NULL, DROP addtype_id, DROP addreason_id');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D146A624E1E FOREIGN KEY (subtracttype_id) REFERENCES subtracttype (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14A2FCFF26 FOREIGN KEY (subtractreason_id) REFERENCES subtractreason (id)');
        $this->addSql('CREATE INDEX IDX_2C1E2D146A624E1E ON gbs (subtracttype_id)');
        $this->addSql('CREATE INDEX IDX_2C1E2D14A2FCFF26 ON gbs (subtractreason_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gbs DROP FOREIGN KEY FK_2C1E2D146A624E1E');
        $this->addSql('ALTER TABLE gbs DROP FOREIGN KEY FK_2C1E2D14A2FCFF26');
        $this->addSql('DROP INDEX IDX_2C1E2D146A624E1E ON gbs');
        $this->addSql('DROP INDEX IDX_2C1E2D14A2FCFF26 ON gbs');
        $this->addSql('ALTER TABLE gbs ADD addtype_id INT NOT NULL, ADD addreason_id INT NOT NULL, DROP subtracttype_id, DROP subtractreason_id');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D144F91A684 FOREIGN KEY (addreason_id) REFERENCES addreason (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14D0A12A3C FOREIGN KEY (addtype_id) REFERENCES addtype (id)');
        $this->addSql('CREATE INDEX IDX_2C1E2D144F91A684 ON gbs (addreason_id)');
        $this->addSql('CREATE INDEX IDX_2C1E2D14D0A12A3C ON gbs (addtype_id)');
    }
}
