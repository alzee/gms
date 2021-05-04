<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504010911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sgb (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, goldclass_id INT NOT NULL, position_id INT NOT NULL, subtracttype_id INT NOT NULL, subtractreason_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight DOUBLE PRECISION NOT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_20F6F20F979B1AD6 (company_id), INDEX IDX_20F6F20FA145C139 (goldclass_id), INDEX IDX_20F6F20FDD842E46 (position_id), INDEX IDX_20F6F20F6A624E1E (subtracttype_id), INDEX IDX_20F6F20FA2FCFF26 (subtractreason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sgb ADD CONSTRAINT FK_20F6F20F979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE sgb ADD CONSTRAINT FK_20F6F20FA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE sgb ADD CONSTRAINT FK_20F6F20FDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE sgb ADD CONSTRAINT FK_20F6F20F6A624E1E FOREIGN KEY (subtracttype_id) REFERENCES subtracttype (id)');
        $this->addSql('ALTER TABLE sgb ADD CONSTRAINT FK_20F6F20FA2FCFF26 FOREIGN KEY (subtractreason_id) REFERENCES subtractreason (id)');
        $this->addSql('DROP TABLE gbs');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gbs (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, goldclass_id INT NOT NULL, position_id INT NOT NULL, subtracttype_id INT NOT NULL, subtractreason_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight DOUBLE PRECISION NOT NULL, note VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2C1E2D14979B1AD6 (company_id), INDEX IDX_2C1E2D14A2FCFF26 (subtractreason_id), INDEX IDX_2C1E2D14A145C139 (goldclass_id), INDEX IDX_2C1E2D14DD842E46 (position_id), INDEX IDX_2C1E2D146A624E1E (subtracttype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D146A624E1E FOREIGN KEY (subtracttype_id) REFERENCES subtracttype (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14A2FCFF26 FOREIGN KEY (subtractreason_id) REFERENCES subtractreason (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('DROP TABLE sgb');
    }
}
