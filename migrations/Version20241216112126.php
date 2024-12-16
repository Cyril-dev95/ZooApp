<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216112126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animaux (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, zoo_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, dangeureux VARCHAR(255) NOT NULL, images VARCHAR(255) NOT NULL, INDEX IDX_9ABE194D97A77B84 (famille_id), INDEX IDX_9ABE194DFA5C94EF (zoo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animaux_continents (animaux_id INT NOT NULL, continents_id INT NOT NULL, INDEX IDX_D91B8894A9DAECAA (animaux_id), INDEX IDX_D91B8894298246F6 (continents_id), PRIMARY KEY(animaux_id, continents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE continents (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE familles (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zoo (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194D97A77B84 FOREIGN KEY (famille_id) REFERENCES familles (id)');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194DFA5C94EF FOREIGN KEY (zoo_id) REFERENCES zoo (id)');
        $this->addSql('ALTER TABLE animaux_continents ADD CONSTRAINT FK_D91B8894A9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animaux_continents ADD CONSTRAINT FK_D91B8894298246F6 FOREIGN KEY (continents_id) REFERENCES continents (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194D97A77B84');
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194DFA5C94EF');
        $this->addSql('ALTER TABLE animaux_continents DROP FOREIGN KEY FK_D91B8894A9DAECAA');
        $this->addSql('ALTER TABLE animaux_continents DROP FOREIGN KEY FK_D91B8894298246F6');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE animaux_continents');
        $this->addSql('DROP TABLE continents');
        $this->addSql('DROP TABLE familles');
        $this->addSql('DROP TABLE zoo');
    }
}
