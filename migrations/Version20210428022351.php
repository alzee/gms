<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428022351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addreason (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE addtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gb ADD company_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD position_id INT NOT NULL');
        $this->addSql('ALTER TABLE gb ADD CONSTRAINT FK_C8D9EFEB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE gb ADD CONSTRAINT FK_C8D9EFEBA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE gb ADD CONSTRAINT FK_C8D9EFEBDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_C8D9EFEB979B1AD6 ON gb (company_id)');
        $this->addSql('CREATE INDEX IDX_C8D9EFEBA145C139 ON gb (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_C8D9EFEBDD842E46 ON gb (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE addreason');
        $this->addSql('DROP TABLE addtype');
        $this->addSql('ALTER TABLE gb DROP FOREIGN KEY FK_C8D9EFEB979B1AD6');
        $this->addSql('ALTER TABLE gb DROP FOREIGN KEY FK_C8D9EFEBA145C139');
        $this->addSql('ALTER TABLE gb DROP FOREIGN KEY FK_C8D9EFEBDD842E46');
        $this->addSql('DROP INDEX IDX_C8D9EFEB979B1AD6 ON gb');
        $this->addSql('DROP INDEX IDX_C8D9EFEBA145C139 ON gb');
        $this->addSql('DROP INDEX IDX_C8D9EFEBDD842E46 ON gb');
        $this->addSql('ALTER TABLE gb DROP company_id, DROP goldclass_id, DROP position_id');
    }
}
