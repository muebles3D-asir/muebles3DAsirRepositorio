<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214111237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD username VARCHAR(25) NOT NULL, ADD is_active TINYINT(1) NOT NULL, DROP name, DROP mail, DROP rol, DROP order_total, CHANGE id id VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) NOT NULL, ADD rol VARCHAR(255) NOT NULL, ADD order_total INT NOT NULL, DROP username, DROP is_active, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
    }
}