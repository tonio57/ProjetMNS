<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225101856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E567F5183');
        $this->addSql('DROP INDEX IDX_DF7DFD0E567F5183 ON seance');
        $this->addSql('ALTER TABLE seance CHANGE film_id films_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E939610EE ON seance (films_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films CHANGE title title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE director director VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E939610EE');
        $this->addSql('DROP INDEX IDX_DF7DFD0E939610EE ON seance');
        $this->addSql('ALTER TABLE seance CHANGE langue langue VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE films_id film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E567F5183 ON seance (film_id)');
    }
}
