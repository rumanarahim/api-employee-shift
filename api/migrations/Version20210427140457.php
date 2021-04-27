<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427140457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE review_id_seq CASCADE');
        $this->addSql('CREATE TABLE Area (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Employee (id INT NOT NULL, role INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, weekly_hours_allowance INT NOT NULL, weekly_hours_rostered INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A4E917F757698A6A ON Employee (role)');
        $this->addSql('CREATE TABLE Link_Area_Employee (employee INT NOT NULL, area INT NOT NULL, PRIMARY KEY(employee, area))');
        $this->addSql('CREATE INDEX IDX_FC46B6E65D9F75A1 ON Link_Area_Employee (employee)');
        $this->addSql('CREATE INDEX IDX_FC46B6E6D7943D68 ON Link_Area_Employee (area)');
        $this->addSql('CREATE TABLE Employee_Qualifications (id INT NOT NULL, employee INT DEFAULT NULL, qualification INT DEFAULT NULL, status INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F421DE7C5D9F75A1 ON Employee_Qualifications (employee)');
        $this->addSql('CREATE INDEX IDX_F421DE7CB712F0CE ON Employee_Qualifications (qualification)');
        $this->addSql('CREATE TABLE Employee_Roles (id INT NOT NULL, employee INT DEFAULT NULL, role INT DEFAULT NULL, proficiency_rating INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_529674625D9F75A1 ON Employee_Roles (employee)');
        $this->addSql('CREATE INDEX IDX_5296746257698A6A ON Employee_Roles (role)');
        $this->addSql('CREATE TABLE File (id INT NOT NULL, employee INT DEFAULT NULL, title VARCHAR(100) NOT NULL, mime VARCHAR(100) NOT NULL, path VARCHAR(255) NOT NULL, size INT NOT NULL, category INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CAD992E5D9F75A1 ON File (employee)');
        $this->addSql('CREATE TABLE Leave (id INT NOT NULL, employee INT DEFAULT NULL, type INT NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A71AFD45D9F75A1 ON Leave (employee)');
        $this->addSql('CREATE TABLE Qualification (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Role (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE Link_Related_Roles (role INT NOT NULL, related_role INT NOT NULL, PRIMARY KEY(role, related_role))');
        $this->addSql('CREATE INDEX IDX_9CDE183157698A6A ON Link_Related_Roles (role)');
        $this->addSql('CREATE INDEX IDX_9CDE1831BC7B2E6F ON Link_Related_Roles (related_role)');
        $this->addSql('CREATE TABLE Link_Area_Role (role INT NOT NULL, area INT NOT NULL, PRIMARY KEY(role, area))');
        $this->addSql('CREATE INDEX IDX_98FE204457698A6A ON Link_Area_Role (role)');
        $this->addSql('CREATE INDEX IDX_98FE2044D7943D68 ON Link_Area_Role (area)');
        $this->addSql('CREATE TABLE Role_Qualifications (id INT NOT NULL, role INT DEFAULT NULL, qualification INT DEFAULT NULL, legal_requirement BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E50C0FB657698A6A ON Role_Qualifications (role)');
        $this->addSql('CREATE INDEX IDX_E50C0FB6B712F0CE ON Role_Qualifications (qualification)');
        $this->addSql('CREATE TABLE Shift (id INT NOT NULL, role INT DEFAULT NULL, employee INT DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64CA144157698A6A ON Shift (role)');
        $this->addSql('CREATE INDEX IDX_64CA14415D9F75A1 ON Shift (employee)');
        $this->addSql('ALTER TABLE Employee ADD CONSTRAINT FK_A4E917F757698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Area_Employee ADD CONSTRAINT FK_FC46B6E65D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Area_Employee ADD CONSTRAINT FK_FC46B6E6D7943D68 FOREIGN KEY (area) REFERENCES Area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Employee_Qualifications ADD CONSTRAINT FK_F421DE7C5D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Employee_Qualifications ADD CONSTRAINT FK_F421DE7CB712F0CE FOREIGN KEY (qualification) REFERENCES Qualification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Employee_Roles ADD CONSTRAINT FK_529674625D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Employee_Roles ADD CONSTRAINT FK_5296746257698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE File ADD CONSTRAINT FK_2CAD992E5D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Leave ADD CONSTRAINT FK_5A71AFD45D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Related_Roles ADD CONSTRAINT FK_9CDE183157698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Related_Roles ADD CONSTRAINT FK_9CDE1831BC7B2E6F FOREIGN KEY (related_role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Area_Role ADD CONSTRAINT FK_98FE204457698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Link_Area_Role ADD CONSTRAINT FK_98FE2044D7943D68 FOREIGN KEY (area) REFERENCES Area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Role_Qualifications ADD CONSTRAINT FK_E50C0FB657698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Role_Qualifications ADD CONSTRAINT FK_E50C0FB6B712F0CE FOREIGN KEY (qualification) REFERENCES Qualification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Shift ADD CONSTRAINT FK_64CA144157698A6A FOREIGN KEY (role) REFERENCES Role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Shift ADD CONSTRAINT FK_64CA14415D9F75A1 FOREIGN KEY (employee) REFERENCES Employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

         $this->addSql("INSERT INTO area VALUES (1, 'Store A')");
         $this->addSql("INSERT INTO area VALUES (2, 'Store B')");


         $this->addSql("INSERT INTO role VALUES (1, 'Sales Assistant')");
         $this->addSql("INSERT INTO role VALUES (2, 'Sales Lead')");

         $this->addSql("INSERT INTO employee VALUES (1, 1, 'Ms.', 'Alice', '', 'Jones', 38, 30, 'Melbourne')");
         $this->addSql("INSERT INTO employee VALUES (2, 1, 'Mr.', 'Mark', '', 'Jones', 15, 10, 'Fitzroy')");
         $this->addSql("INSERT INTO employee VALUES (3, 2, 'Ms.', 'Sandra', '', 'Jones', 38, 3, 'Brunswick')");

         $this->addSql("INSERT INTO employee_roles VALUES (1, 1, 1, 4)");
         $this->addSql("INSERT INTO employee_roles VALUES (2, 1, 2, 2)");
         $this->addSql("INSERT INTO employee_roles VALUES (3, 2, 1, 2)");
         $this->addSql("INSERT INTO employee_roles VALUES (4, 3, 1, 4)");
         $this->addSql("INSERT INTO employee_roles VALUES (5, 3, 2, 4)");

         $this->addSql("INSERT INTO qualification VALUES(1, 'Management People Certificate')");
         $this->addSql("INSERT INTO qualification VALUES(2, 'Leadership')");

         $this->addSql("INSERT INTO employee_qualifications VALUES (1, 3, 1, 1)");

         $this->addSql("INSERT INTO leave VALUES (1, 1, 1, '2021-02-26 00:00:00', '2021-02-27 23:59:59', 1)");

         $this->addSql("INSERT INTO link_area_employee VALUES(1,1)");
         $this->addSql("INSERT INTO link_area_employee VALUES(3,1)");
         $this->addSql("INSERT INTO link_area_employee VALUES(2,1)");

         $this->addSql("INSERT INTO link_area_role VALUES(1,1)");
         $this->addSql("INSERT INTO link_area_role VALUES(2,1)");

         $this->addSql("INSERT INTO link_related_roles VALUES(2,1)");

         $this->addSql("INSERT INTO role_qualifications VALUES (1,2,1, false)");
         $this->addSql("INSERT INTO role_qualifications VALUES (2,1,1, false)");

         $this->addSql("INSERT INTO shift VALUES (1,1,2, '2021-02-26 09:00:00', '2021-02-26 17:00:00')");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE Link_Area_Employee DROP CONSTRAINT FK_FC46B6E6D7943D68');
        $this->addSql('ALTER TABLE Link_Area_Role DROP CONSTRAINT FK_98FE2044D7943D68');
        $this->addSql('ALTER TABLE Link_Area_Employee DROP CONSTRAINT FK_FC46B6E65D9F75A1');
        $this->addSql('ALTER TABLE Employee_Qualifications DROP CONSTRAINT FK_F421DE7C5D9F75A1');
        $this->addSql('ALTER TABLE Employee_Roles DROP CONSTRAINT FK_529674625D9F75A1');
        $this->addSql('ALTER TABLE File DROP CONSTRAINT FK_2CAD992E5D9F75A1');
        $this->addSql('ALTER TABLE Leave DROP CONSTRAINT FK_5A71AFD45D9F75A1');
        $this->addSql('ALTER TABLE Shift DROP CONSTRAINT FK_64CA14415D9F75A1');
        $this->addSql('ALTER TABLE Employee_Qualifications DROP CONSTRAINT FK_F421DE7CB712F0CE');
        $this->addSql('ALTER TABLE Role_Qualifications DROP CONSTRAINT FK_E50C0FB6B712F0CE');
        $this->addSql('ALTER TABLE Employee DROP CONSTRAINT FK_A4E917F757698A6A');
        $this->addSql('ALTER TABLE Employee_Roles DROP CONSTRAINT FK_5296746257698A6A');
        $this->addSql('ALTER TABLE Link_Related_Roles DROP CONSTRAINT FK_9CDE183157698A6A');
        $this->addSql('ALTER TABLE Link_Related_Roles DROP CONSTRAINT FK_9CDE1831BC7B2E6F');
        $this->addSql('ALTER TABLE Link_Area_Role DROP CONSTRAINT FK_98FE204457698A6A');
        $this->addSql('ALTER TABLE Role_Qualifications DROP CONSTRAINT FK_E50C0FB657698A6A');
        $this->addSql('ALTER TABLE Shift DROP CONSTRAINT FK_64CA144157698A6A');
        $this->addSql('CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE review_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE Area');
        $this->addSql('DROP TABLE Employee');
        $this->addSql('DROP TABLE Link_Area_Employee');
        $this->addSql('DROP TABLE Employee_Qualifications');
        $this->addSql('DROP TABLE Employee_Roles');
        $this->addSql('DROP TABLE File');
        $this->addSql('DROP TABLE Leave');
        $this->addSql('DROP TABLE Qualification');
        $this->addSql('DROP TABLE Role');
        $this->addSql('DROP TABLE Link_Related_Roles');
        $this->addSql('DROP TABLE Link_Area_Role');
        $this->addSql('DROP TABLE Role_Qualifications');
        $this->addSql('DROP TABLE Shift');
    }
}
