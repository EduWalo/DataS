

CREATE TABLE user
(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nameuser VARCHAR(50),
    password TEXT,
    mail VARCHAR(60),
    type_user INT(11)
);


CREATE TABLE personal_data
(
    id_student INT(11) NOT NULL PRIMARY KEY,
    genero VARCHAR(20),
    grado VARCHAR(20),
    range_edad VARCHAR(20),
    FOREIGN KEY(id_student) REFERENCES user (id)
);


CREATE TABLE student_answer 
(
    id_student INT(11) PRIMARY KEY,
    p1  VARCHAR(2) NOT NULL,
    p2  VARCHAR(2) NOT NULL,
    p3  VARCHAR(2) NOT NULL,
    p4  VARCHAR(2) NOT NULL,
    p5  VARCHAR(2) NOT NULL,
    p6  VARCHAR(2) NOT NULL,
    p7  VARCHAR(2) NOT NULL,
    p8  VARCHAR(2) NOT NULL,
    p9  VARCHAR(2) NOT NULL,
    p10 VARCHAR(2) NOT NULL,
    p11 VARCHAR(2) NOT NULL,
    p12 VARCHAR(2) NOT NULL,
    p13 VARCHAR(2) NOT NULL,
    p14 VARCHAR(2) NOT NULL,
    p15 VARCHAR(2) NOT NULL,
    p16 VARCHAR(2) NOT NULL,
    p17 VARCHAR(2) NOT NULL,
    p18 VARCHAR(2) NOT NULL,
    p19 VARCHAR(2) NOT NULL,
    p20 VARCHAR(2) NOT NULL,
    p21 VARCHAR(2) NOT NULL,
    p22 VARCHAR(2) NOT NULL,
    p23 VARCHAR(2) NOT NULL,
    p24 VARCHAR(2) NOT NULL,
    p25 VARCHAR(2) NOT NULL,
    p26 VARCHAR(2) NOT NULL,
    p27 VARCHAR(2) NOT NULL,
    p28 VARCHAR(2) NOT NULL,
    p29 VARCHAR(2) NOT NULL,
    p30 VARCHAR(2) NOT NULL,
    p31 VARCHAR(2) NOT NULL,
    p32 VARCHAR(2) NOT NULL,
    p33 VARCHAR(2) NOT NULL,
    p34 VARCHAR(2) NOT NULL,
    p35 VARCHAR(2) NOT NULL,
    p36 VARCHAR(2) NOT NULL,
    p37 VARCHAR(2) NOT NULL,
    p38 VARCHAR(2) NOT NULL,
    p39 VARCHAR(2) NOT NULL,
    p40 VARCHAR(2) NOT NULL,
    p41 VARCHAR(2) NOT NULL,
    p42 VARCHAR(2) NOT NULL,
    p43 VARCHAR(2) NOT NULL,
    p44 VARCHAR(2) NOT NULL,
    FOREIGN KEY(id_student) REFERENCES user (id)
);

CREATE TABLE student_result
(
    id_student INT(11) PRIMARY KEY,
    process VARCHAR(4),
    process_value INT(11),

    perception VARCHAR(4),
    perception_value INT(11),

    channel VARCHAR(4),
    channel_value INT(11),

    understand VARCHAR(4),
    understand_value INT(11),

    FOREIGN KEY(id_student) REFERENCES user (id)
);