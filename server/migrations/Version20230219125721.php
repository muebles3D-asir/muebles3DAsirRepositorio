<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219125721 extends AbstractMigration {
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture_category DROP FOREIGN KEY FK_5217AE1DCF5485C3');
        $this->addSql('ALTER TABLE furniture_category DROP FOREIGN KEY FK_5217AE1D12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE furniture_category');
        $this->addSql('ALTER TABLE furniture ADD filamento VARCHAR(255) NOT NULL, ADD color VARCHAR(255) NOT NULL, ADD material VARCHAR(255) NOT NULL, ADD tamaño DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(25) NOT NULL, ADD is_active TINYINT(1) NOT NULL, DROP name, DROP mail, DROP rol, DROP order_total, CHANGE id id VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE furniture_category (furniture_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_5217AE1DCF5485C3 (furniture_id), INDEX IDX_5217AE1D12469DE2 (category_id), PRIMARY KEY(furniture_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE furniture_category ADD CONSTRAINT FK_5217AE1DCF5485C3 FOREIGN KEY (furniture_id) REFERENCES furniture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE furniture_category ADD CONSTRAINT FK_5217AE1D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE furniture DROP filamento, DROP color, DROP material, DROP tamaño');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD mail VARCHAR(255) NOT NULL, ADD rol VARCHAR(255) NOT NULL, ADD order_total INT NOT NULL, DROP username, DROP is_active, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
    }
}
