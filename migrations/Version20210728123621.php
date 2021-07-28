<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728123621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device_users DROP FOREIGN KEY device_users_ibfk_2');
        //$this->addSql('DROP TABLE device_users');
        //$this->addSql('DROP TABLE issues');
        //$this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE device_users (device_users_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, device_id INT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, INDEX device_id (device_id), INDEX user_id (user_id), PRIMARY KEY(device_users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE issues (issue_id INT AUTO_INCREMENT NOT NULL, device_id INT NOT NULL, if_available TINYINT(1) DEFAULT NULL, if_expired TINYINT(1) DEFAULT NULL, INDEX device_id (device_id), PRIMARY KEY(issue_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (user_id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, position VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE device_users ADD CONSTRAINT device_users_ibfk_1 FOREIGN KEY (device_id) REFERENCES devices (device_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE device_users ADD CONSTRAINT device_users_ibfk_2 FOREIGN KEY (user_id) REFERENCES users (user_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT issues_ibfk_1 FOREIGN KEY (device_id) REFERENCES devices (device_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
