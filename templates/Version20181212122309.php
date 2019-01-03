<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212122309 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2256B4662 FOREIGN KEY (IdStudent) REFERENCES student_profile (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2256B4662 ON education (IdStudent)');
        $this->addSql('ALTER TABLE experience ADD IdStudent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103256B4662 FOREIGN KEY (IdStudent) REFERENCES student_profile (id)');
        $this->addSql('CREATE INDEX IDX_590C103256B4662 ON experience (IdStudent)');
        $this->addSql('ALTER TABLE posts DROP date, CHANGE numberOfLikes numberOfLikes INT NOT NULL, CHANGE numberOfComments numberOfComments INT NOT NULL');
        $this->addSql('ALTER TABLE skills CHANGE IdStudent IdStudent INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2256B4662');
        $this->addSql('DROP INDEX IDX_DB0A5ED2256B4662 ON education');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103256B4662');
        $this->addSql('DROP INDEX IDX_590C103256B4662 ON experience');
        $this->addSql('ALTER TABLE experience DROP IdStudent');
        $this->addSql('ALTER TABLE posts ADD date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE numberOfLikes numberOfLikes INT DEFAULT 0 NOT NULL, CHANGE numberOfComments numberOfComments INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE skills CHANGE IdStudent IdStudent INT NOT NULL');
    }
}
