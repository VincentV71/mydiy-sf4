<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704152008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE arome_recette (id_arome_recette INT AUTO_INCREMENT NOT NULL, id_recet_id INT NOT NULL, id_aro_id INT NOT NULL, dos_aro NUMERIC(3, 1) NOT NULL, INDEX IDX_BD702E63A0ED6873 (id_recet_id), INDEX IDX_BD702E632D0A8069 (id_aro_id), PRIMARY KEY(id_arome_recette)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E63A0ED6873 FOREIGN KEY (id_recet_id) REFERENCES recette (id_recet)');
        $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E632D0A8069 FOREIGN KEY (id_aro_id) REFERENCES arome (id_aro)');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_COMMENTER');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_REDIGER');
        $this->addSql('ALTER TABLE avis CHANGE id_member id_member INT DEFAULT NULL, CHANGE id_recet id_recet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A23E5D0D FOREIGN KEY (id_recet) REFERENCES recette (id_recet)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member)');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_VENDRE');
        $this->addSql('ALTER TABLE prix CHANGE id_aro id_aro INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EE8F4F7E2 FOREIGN KEY (id_aro) REFERENCES arome (id_aro)');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_CUISINER');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_UTILISER');
        $this->addSql('ALTER TABLE recette CHANGE id_member id_member INT DEFAULT NULL, CHANGE id_base id_base INT DEFAULT NULL, CHANGE etoiles etoiles INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904B94E263 FOREIGN KEY (id_base) REFERENCES base (id_base)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE arome_recette');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A23E5D0D');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF056D34F95');
        $this->addSql('ALTER TABLE avis CHANGE id_recet id_recet INT NOT NULL, CHANGE id_member id_member INT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_COMMENTER FOREIGN KEY (id_recet) REFERENCES recette (id_recet) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_REDIGER FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EE8F4F7E2');
        $this->addSql('ALTER TABLE prix CHANGE id_aro id_aro INT NOT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_VENDRE FOREIGN KEY (id_aro) REFERENCES arome (id_aro) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639056D34F95');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904B94E263');
        $this->addSql('ALTER TABLE recette CHANGE id_member id_member INT NOT NULL, CHANGE id_base id_base INT NOT NULL, CHANGE etoiles etoiles INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_CUISINER FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_UTILISER FOREIGN KEY (id_base) REFERENCES base (id_base) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
