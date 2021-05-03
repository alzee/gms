<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503112448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE box (id INT AUTO_INCREMENT NOT NULL, clerk_id INT DEFAULT NULL, artisan_id INT DEFAULT NULL, goldclass_id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, INDEX IDX_8A9483AD95C1FC6 (clerk_id), INDEX IDX_8A9483A5ED3C7B7 (artisan_id), INDEX IDX_8A9483AA145C139 (goldclass_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AD95C1FC6 FOREIGN KEY (clerk_id) REFERENCES clerk (id)');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A5ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE box');
    }
}
