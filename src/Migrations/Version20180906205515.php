<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906205515 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE cardtypes');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE shows');
        $this->addSql('DROP TABLE showtypes');
        $this->addSql('DROP TABLE tickets');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bookings (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, clientId SMALLINT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cards (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, cardNumber INT UNSIGNED NOT NULL, cardTypesId SMALLINT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cardtypes (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(45) NOT NULL COLLATE utf8_general_ci, discount INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, lastName VARCHAR(45) NOT NULL COLLATE utf8_general_ci, firstName VARCHAR(45) NOT NULL COLLATE utf8_general_ci, birthDate DATE NOT NULL, card TINYINT(1) NOT NULL, cardNumber INT UNSIGNED DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, genre VARCHAR(45) NOT NULL COLLATE utf8_general_ci, showTypesId SMALLINT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shows (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL COLLATE utf8_general_ci, performer VARCHAR(45) NOT NULL COLLATE utf8_general_ci, date DATE NOT NULL, showTypesId SMALLINT UNSIGNED NOT NULL, firstGenresId SMALLINT UNSIGNED NOT NULL, secondGenreId SMALLINT UNSIGNED NOT NULL, duration TIME NOT NULL, startTime TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE showtypes (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(45) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, bookingsId SMALLINT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE article');
    }
}
