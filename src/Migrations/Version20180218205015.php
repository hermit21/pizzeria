<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180218205015 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, descriptions VARCHAR(100) NOT NULL, score INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE components (id INT AUTO_INCREMENT NOT NULL, ingredients VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, date_time_request DATETIME NOT NULL, size VARCHAR(10) NOT NULL, descriptions VARCHAR(100) NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, descriptions VARCHAR(100) NOT NULL, price VARCHAR(40) NOT NULL, ingredients VARCHAR(100) NOT NULL, size VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, surname VARCHAR(20) NOT NULL, address VARCHAR(45) NOT NULL, telephon_number VARCHAR(9) NOT NULL, username VARCHAR(45) NOT NULL, password VARCHAR(128) NOT NULL, salt VARCHAR(64) NOT NULL, activate_token VARCHAR(64) NOT NULL, password_token VARCHAR(64) NOT NULL, privilage_user INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE components');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE pizza_list');
        $this->addSql('DROP TABLE users');
    }
}
