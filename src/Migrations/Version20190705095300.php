<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190705095300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE arome_recette DROP FOREIGN KEY FK_BD702E632D0A8069');
        // $this->addSql('ALTER TABLE arome_recette DROP FOREIGN KEY FK_BD702E63A0ED6873');
        // $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E632D0A8069 FOREIGN KEY (id_aro_id) REFERENCES arome (id_aro) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E63A0ED6873 FOREIGN KEY (id_recet_id) REFERENCES recette (id_recet) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF056D34F95');
        // $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A23E5D0D');
        // $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A23E5D0D FOREIGN KEY (id_recet) REFERENCES recette (id_recet) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EE8F4F7E2');
        // $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EE8F4F7E2 FOREIGN KEY (id_aro) REFERENCES arome (id_aro) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904B94E263');
        // $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639056D34F95');
        // $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904B94E263 FOREIGN KEY (id_base) REFERENCES base (id_base) ON UPDATE CASCADE ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASC');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE arome_recette DROP FOREIGN KEY FK_BD702E63A0ED6873');
        $this->addSql('ALTER TABLE arome_recette DROP FOREIGN KEY FK_BD702E632D0A8069');
        $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E63A0ED6873 FOREIGN KEY (id_recet_id) REFERENCES recette (id_recet) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arome_recette ADD CONSTRAINT FK_BD702E632D0A8069 FOREIGN KEY (id_aro_id) REFERENCES arome (id_aro) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A23E5D0D');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF056D34F95');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A23E5D0D FOREIGN KEY (id_recet) REFERENCES recette (id_recet) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EE8F4F7E2');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EE8F4F7E2 FOREIGN KEY (id_aro) REFERENCES arome (id_aro) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639056D34F95');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904B94E263');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639056D34F95 FOREIGN KEY (id_member) REFERENCES member (id_member) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904B94E263 FOREIGN KEY (id_base) REFERENCES base (id_base) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
