<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428012811 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gd ADD maindoc_id INT NOT NULL, ADD team_id INT NOT NULL, ADD artisan_id INT NOT NULL, ADD goldclass_id INT NOT NULL, ADD position_id INT NOT NULL, ADD weight DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE gd ADD CONSTRAINT FK_21BA4ADEA0321766 FOREIGN KEY (maindoc_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE gd ADD CONSTRAINT FK_21BA4ADE296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE gd ADD CONSTRAINT FK_21BA4ADE5ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('ALTER TABLE gd ADD CONSTRAINT FK_21BA4ADEA145C139 FOREIGN KEY (goldclass_id) REFERENCES goldclass (id)');
        $this->addSql('ALTER TABLE gd ADD CONSTRAINT FK_21BA4ADEDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_21BA4ADEA0321766 ON gd (maindoc_id)');
        $this->addSql('CREATE INDEX IDX_21BA4ADE296CD8AE ON gd (team_id)');
        $this->addSql('CREATE INDEX IDX_21BA4ADE5ED3C7B7 ON gd (artisan_id)');
        $this->addSql('CREATE INDEX IDX_21BA4ADEA145C139 ON gd (goldclass_id)');
        $this->addSql('CREATE INDEX IDX_21BA4ADEDD842E46 ON gd (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADEA0321766');
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADE296CD8AE');
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADE5ED3C7B7');
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADEA145C139');
        $this->addSql('ALTER TABLE gd DROP FOREIGN KEY FK_21BA4ADEDD842E46');
        $this->addSql('DROP INDEX IDX_21BA4ADEA0321766 ON gd');
        $this->addSql('DROP INDEX IDX_21BA4ADE296CD8AE ON gd');
        $this->addSql('DROP INDEX IDX_21BA4ADE5ED3C7B7 ON gd');
        $this->addSql('DROP INDEX IDX_21BA4ADEA145C139 ON gd');
        $this->addSql('DROP INDEX IDX_21BA4ADEDD842E46 ON gd');
        $this->addSql('ALTER TABLE gd DROP maindoc_id, DROP team_id, DROP artisan_id, DROP goldclass_id, DROP position_id, DROP weight');
    }
}
