<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504083836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz_results (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, result INT NOT NULL, INDEX IDX_F5493BC09D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_results_quizz (quizz_results_id INT NOT NULL, quizz_id INT NOT NULL, INDEX IDX_64454A0EC45C4589 (quizz_results_id), INDEX IDX_64454A0EBA934BCD (quizz_id), PRIMARY KEY(quizz_results_id, quizz_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz_results ADD CONSTRAINT FK_F5493BC09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE quizz_results_quizz ADD CONSTRAINT FK_64454A0EC45C4589 FOREIGN KEY (quizz_results_id) REFERENCES quizz_results (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizz_results_quizz ADD CONSTRAINT FK_64454A0EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz_results_quizz DROP FOREIGN KEY FK_64454A0EC45C4589');
        $this->addSql('DROP TABLE quizz_results');
        $this->addSql('DROP TABLE quizz_results_quizz');
    }
}
