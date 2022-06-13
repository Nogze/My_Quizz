<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:my_quizz/migrations/Version20220505125849.php
final class Version20220505125849 extends AbstractMigration
=======
final class Version20220504085929 extends AbstractMigration
>>>>>>> dev:my_quizz/migrations/Version20220504085929.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
<<<<<<< HEAD:my_quizz/migrations/Version20220505125849.php
        $this->addSql('ALTER TABLE users DROP permission');
=======
        $this->addSql('ALTER TABLE quizz ADD author VARCHAR(255) DEFAULT NULL');
>>>>>>> dev:my_quizz/migrations/Version20220504085929.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
<<<<<<< HEAD:my_quizz/migrations/Version20220505125849.php
        $this->addSql('ALTER TABLE users ADD permission TINYINT(1) DEFAULT NULL');
=======
        $this->addSql('ALTER TABLE quizz DROP author');
>>>>>>> dev:my_quizz/migrations/Version20220504085929.php
    }
}
