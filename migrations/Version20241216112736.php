<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216112736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animaux_continents (animaux_id INT NOT NULL, continents_id INT NOT NULL, INDEX IDX_D91B8894A9DAECAA (animaux_id), INDEX IDX_D91B8894298246F6 (continents_id), PRIMARY KEY(animaux_id, continents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animaux_continents ADD CONSTRAINT FK_D91B8894A9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animaux_continents ADD CONSTRAINT FK_D91B8894298246F6 FOREIGN KEY (continents_id) REFERENCES continents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animaux CHANGE famille_id famille_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux_continents DROP FOREIGN KEY FK_D91B8894A9DAECAA');
        $this->addSql('ALTER TABLE animaux_continents DROP FOREIGN KEY FK_D91B8894298246F6');
        $this->addSql('DROP TABLE animaux_continents');
        $this->addSql('ALTER TABLE animaux CHANGE famille_id famille_id INT NOT NULL');
    }
}
