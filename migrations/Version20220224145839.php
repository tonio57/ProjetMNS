<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224145839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films CHANGE seance seance VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films CHANGE title title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE director director VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE seance seance VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE seance CHANGE langue langue VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE film film VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
