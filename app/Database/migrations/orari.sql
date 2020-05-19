DROP DATABASE IF EXISTS orari;

CREATE DATABASE orari CHARACTER SET utf8 COLLATE utf8_general_ci;

use orari;

CREATE TABLE `role`
(
    role_id     int NOT NULL AUTO_INCREMENT,
    title       varchar(255),
    description varchar(255),
    created_at  timestamp,
    updated_at  timestamp,
    PRIMARY KEY (role_id)
);

CREATE TABLE `user`
(
    user_id    int NOT NULL AUTO_INCREMENT,
    first_name varchar(255),
    last_name  varchar(255),
    email      varchar(255) UNIQUE,
    password   varchar(255),
    role_id    int,
    created_at timestamp,
    updated_at timestamp,
    PRIMARY KEY (user_id),
    FOREIGN KEY (role_id) REFERENCES `role` (role_id)
);

CREATE TABLE `teacher_type`
(
    teacher_type_id int NOT NULL AUTO_INCREMENT,
    title           varchar(255),
    description     varchar(255),
    created_at      timestamp,
    updated_at      timestamp,
    PRIMARY KEY (teacher_type_id)
);

CREATE TABLE `teacher`
(
    teacher_id      int NOT NULL,
    teacher_type_id int,
    created_at      timestamp,
    updated_at      timestamp,
    PRIMARY KEY (teacher_id),
    FOREIGN KEY (teacher_id) REFERENCES `user` (user_id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_type_id) REFERENCES `teacher_type` (teacher_type_id)
);

CREATE TABLE `academic_year`
(
    academic_year_id int        NOT NULL AUTO_INCREMENT,
    year             int UNIQUE NOT NULL,
    description      varchar(255),
    active           BIT DEFAULT 0,
    created_at       timestamp,
    updated_at       timestamp,
    PRIMARY KEY (academic_year_id)
);

CREATE TABLE `semester`
(
    semester_id int NOT NULL AUTO_INCREMENT,
    number      int,
    description varchar(255),
    created_at  timestamp,
    updated_at  timestamp,
    PRIMARY KEY (semester_id)
);

CREATE TABLE `group_type`
(
    group_type_id int NOT NULL AUTO_INCREMENT,
    title         varchar(255),
    description   varchar(255),
    created_at    timestamp,
    updated_at    timestamp,
    PRIMARY KEY (group_type_id)
);

CREATE TABLE `group`
(
    group_id      int NOT NULL AUTO_INCREMENT,
    number        INT,
    description   varchar(255),
    group_type_id INT,
    semester_id   INT,
    created_at    timestamp,
    updated_at    timestamp,
    PRIMARY KEY (group_id),
    FOREIGN KEY (group_type_id) REFERENCES `group_type` (group_type_id),
    FOREIGN KEY (semester_id) REFERENCES `semester` (semester_id),
    UNIQUE KEY `number_group_type_semester` (`number`, `group_type_id`,`semester_id`)
);

CREATE TABLE `student`
(
    student_id          int NOT NULL,
    semester_id         INT,
    subjects_registered BIT DEFAULT 0,
    created_at          timestamp,
    updated_at          timestamp,
    PRIMARY KEY (student_id),
    FOREIGN KEY (student_id) REFERENCES `user` (user_id) ON DELETE CASCADE,
    FOREIGN KEY (semester_id) REFERENCES `semester` (semester_id)
);

CREATE TABLE `student_group`
(
    student_id       INT NOT NULL,
    group_id         INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES `student` (student_id),
    FOREIGN KEY (group_id) REFERENCES `group` (group_id),
    UNIQUE KEY `student_group` (`student_id`, `group_id`)
);

CREATE TABLE `subject_type`
(
    subject_type_id int NOT NULL AUTO_INCREMENT,
    title           varchar(255),
    description     varchar(255),
    created_at      timestamp,
    updated_at      timestamp,
    PRIMARY KEY (subject_type_id)
);

CREATE TABLE `subject`
(
    subject_id      int NOT NULL AUTO_INCREMENT,
    title           varchar(255),
    code            varchar(255),
    ects_credits    int,
    subject_type_id int,
    semester_id     int,
    created_at      timestamp,
    updated_at      timestamp,
    PRIMARY KEY (subject_id),
    FOREIGN KEY (subject_type_id) REFERENCES `subject_type` (subject_type_id),
    FOREIGN KEY (semester_id) REFERENCES `semester` (semester_id)
);

CREATE TABLE `classroom_type`
(
    classroom_type_id int NOT NULL AUTO_INCREMENT,
    title             varchar(255),
    description       varchar(255),
    created_at        timestamp,
    updated_at        timestamp,
    PRIMARY KEY (classroom_type_id)
);

CREATE TABLE `classroom`
(
    classroom_id      int NOT NULL AUTO_INCREMENT,
    number            varchar(255),
    classroom_type_id INT,
    created_at        timestamp,
    updated_at        timestamp,
    PRIMARY KEY (classroom_id),
    FOREIGN KEY (classroom_type_id) REFERENCES `classroom_type` (classroom_type_id)
);

CREATE TABLE `schedule_type`
(
    schedule_type_id int NOT NULL AUTO_INCREMENT,
    title            varchar(255),
    description      varchar(255),
    created_at       timestamp,
    updated_at       timestamp,
    PRIMARY KEY (schedule_type_id)
);

CREATE TABLE `subject_teacher`
(
    subject_teacher_id int NOT NULL AUTO_INCREMENT,
    subject_id         INT,
    teacher_id         INT,
    academic_year_id   INT,
    created_at         timestamp,
    updated_at         timestamp,
    PRIMARY KEY (subject_teacher_id),
    FOREIGN KEY (subject_id) REFERENCES `subject` (subject_id),
    FOREIGN KEY (teacher_id) REFERENCES `teacher` (teacher_id),
    FOREIGN KEY (academic_year_id) REFERENCES `academic_year` (academic_year_id),
    UNIQUE KEY `subject_teacher` (`subject_id`, `teacher_id`, `academic_year_id`)
);

CREATE TABLE `schedule`
(
    schedule_id        INT NOT NULL AUTO_INCREMENT,
    day_of_week        INT,
    start_time         INT,
    end_time           INT,
    schedule_type_id   INT,
    subject_teacher_id INT,
    group_id           INT,
    semester_id        INT,
    classroom_id       INT,
    academic_year_id   INT,
    PRIMARY KEY (schedule_id),
    FOREIGN KEY (schedule_type_id) REFERENCES `schedule_type` (schedule_type_id),
    FOREIGN KEY (subject_teacher_id) REFERENCES `subject_teacher` (subject_teacher_id),
    FOREIGN KEY (group_id) REFERENCES `group` (group_id),
    FOREIGN KEY (semester_id) REFERENCES `semester` (semester_id),
    FOREIGN KEY (classroom_id) REFERENCES `classroom` (classroom_id),
    FOREIGN KEY (academic_year_id) REFERENCES `academic_year` (academic_year_id)
);

CREATE TABLE `student_subject`
(
    student_id         INT NOT NULL,
    subject_id         INT NOT NULL,
    created_at         timestamp,
    updated_at         timestamp,
    FOREIGN KEY (student_id) REFERENCES `student` (student_id),
    FOREIGN KEY (subject_id) REFERENCES `subject` (subject_id),
    UNIQUE KEY `student_group` (`student_id`, `subject_id`)
);

# Initial data

#Roles
INSERT INTO `role` (title, description, created_at, updated_at)
values ('admin', 'Administrator', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `role` (title, description, created_at, updated_at)
values ('teacher', 'Ligjërues', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `role` (title, description, created_at, updated_at)
values ('student', 'Student', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Users
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Kreshnik', 'Gashi', 'kreshnikg3@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 1,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Filan', 'Fisteku', 'filanfisteku@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 3,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Zirije', 'Hasani', 'zirijehasani@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 2,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Ercan', 'Canhasi', 'ercancanhasi@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 2,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Samedin', 'Krrabaj', 'samedinkrrabaj@gmail.com',
        '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Arsim', 'Susuri', 'arsimsusuri@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 2,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `user` (first_name, last_name, email, password, role_id, created_at, updated_at)
values ('Arta', 'Misini', 'artamisini@gmail.com', '$2y$10$xtfrdhBlBulXu65/7KNc/O00xm.Bdpg2Z3E2CYDvk/tDlx1.RABLS', 2,
        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
#password: 12345678

#Semesters
INSERT INTO `semester` (number, description, created_at, updated_at)
values (1, 'Semestri I', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (2, 'Semestri II', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (3, 'Semestri III', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (4, 'Semestri IV', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (5, 'Semestri V', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (6, 'Semestri VI', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (7, 'Semestri VII', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `semester` (number, description, created_at, updated_at)
values (8, 'Semestri VIII', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Academic years
INSERT INTO `academic_year` (year, description, created_at, updated_at)
values (2018, '2018/2019', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `academic_year` (year, description, active, created_at, updated_at)
values (2019, '2019/2020', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Students
INSERT INTO `student` (student_id, semester_id, created_at, updated_at)
values (2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Teacher types
INSERT INTO `teacher_type` (title, description, created_at, updated_at)
values ('profesor', 'Profesor', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher_type` (title, description, created_at, updated_at)
values ('profesor-asistent', 'Profesor/Asistent', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher_type` (title, description, created_at, updated_at)
values ('asistent', 'Asistent', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Teachers
INSERT INTO `teacher` (teacher_id, teacher_type_id, created_at, updated_at)
values (3, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher` (teacher_id, teacher_type_id, created_at, updated_at)
values (4, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher` (teacher_id, teacher_type_id, created_at, updated_at)
values (5, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher` (teacher_id, teacher_type_id, created_at, updated_at)
values (6, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `teacher` (teacher_id, teacher_type_id, created_at, updated_at)
values (7, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Group types
INSERT INTO `group_type` (title, description, created_at, updated_at)
values ('L', 'Ligjërata', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `group_type` (title, description, created_at, updated_at)
values ('U', 'Ushtrime', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Subject types
INSERT INTO `subject_type` (title, description, created_at, updated_at)
values ('O', 'Obligative', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject_type` (title, description, created_at, updated_at)
values ('Z', 'Zgjedhore', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Schedule types
INSERT INTO `schedule_type` (title, description, created_at, updated_at)
values ('L', 'Ligjërata', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `schedule_type` (title, description, created_at, updated_at)
values ('U', 'Ushtrime', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Classroom types
INSERT INTO `classroom_type` (title, description, created_at, updated_at)
values ('S', 'Sallë', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom_type` (title, description, created_at, updated_at)
values ('Lab', 'Laborator', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Classrooms
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('421', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('422', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('423', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('430', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('431', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `classroom` (number, classroom_type_id, created_at, updated_at)
values ('432', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

#Subjects
#semester1
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Hyrje në Informatikë', '15-03B06S-1O01', 6, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Matematikë I', '15-03B06S-1O02', 6, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Hyrje në Programim', '15-03B06S-1O03', 6, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Media e re dhe Multimedia', '15-03B06S-1O04', 6, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Anglisht për shkenca kompjuterike I', '15-03B06S-1Z07', 6, 2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Hyrje në Rrjeta', '15-03B06S-1Z06', 6, 2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('IT dhe Ndermarresia', '15-03B06S-1Z05', 6, 2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
#semester2
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Algoritmet dhe strukturat e te dhenave', '15-03B06S-2O01', 6, 1, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Hyrje ne web gjuhet dhe teknologjite', '15-03B06S-2O02', 6, 1, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Matematikë Diskrete', '15-03B06S-2O03', 6, 1, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Sisteme operative dhe menaxhimi I sistemeve', '15-03B06S-2O04', 6, 1, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Anglisht per shkenca kompjuterike II', '15-03B06S-2Z06', 6, 2, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Protokollet e internetit', '15-03B06S-2Z05', 6, 2, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO `subject` (title, code, ects_credits, subject_type_id, semester_id, created_at, updated_at)
values ('Interaksioni njeri -kompjuter', '15-03B06S-2Z07', 6, 2, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



















