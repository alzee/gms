<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504001036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gbs (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, goldclass_id INT NOT NULL, position_id INT NOT NULL, addtype_id INT NOT NULL, addreason_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight DOUBLE PRECISION NOT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_2C1E2D14979B1AD6 (company_id), INDEX IDX_2C1E2D14A145C139 (goldclass_id), INDEX IDX_2C1E2D14DD842E46 (position_id), INDEX IDX_2C1E2D14D0A12A3C (addtype_id), INDEX IDX_2C1E2D144F91A684 (addreason_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14A145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D14D0A12A3C FOREIGN KEY (addtype_id) REFERENCES addtype (id)');
        $this->addSql('ALTER TABLE gbs ADD CONSTRAINT FK_2C1E2D144F91A684 FOREIGN KEY (addreason_id) REFERENCES addreason (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gbs');
    }
}
