-- Create Moderator table --
DROP TABLE IF EXISTS `MODERATOR`;
CREATE TABLE `MODERATOR` (
    moderatorId CHAR(8) NOT NULL, 
    `name` CHAR(50) NOT NULL,
    email CHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    imageUrl VARCHAR(255),
    lastLogin TIMESTAMP NOT NULL DEFAULT 0,
    status INT NOT NULL DEFAULT 1,
    PRIMARY KEY(moderatorId),
    UNIQUE(email)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

INSERT INTO `MODERATOR` VALUES('C4H7HLhY', 'Faruk Nasir', 'frknasir@yahoo.com', 
'e4cc3bb4884beeb52e30367fd00a7f86', '', 'now()', '1');

-- Create State table --
DROP TABLE IF EXISTS `STATE`;
CREATE TABLE `STATE`( 
    stateId INT NOT NULL AUTO_INCREMENT,
    stateName CHAR(50) NOT NULL,
    PRIMARY KEY(stateId)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Insert into state table --
INSERT INTO `STATE`(stateName) VALUES("Abia");
INSERT INTO `STATE`(stateName) VALUES("Adamawa");
INSERT INTO `STATE`(stateName) VALUES("Akwa Ibom");
INSERT INTO `STATE`(stateName) VALUES("Anambra");
INSERT INTO `STATE`(stateName) VALUES("Bauchi");
INSERT INTO `STATE`(stateName) VALUES("Bayelsa");
INSERT INTO `STATE`(stateName) VALUES("Benue");
INSERT INTO `STATE`(stateName) VALUES("Bornu");
INSERT INTO `STATE`(stateName) VALUES("Cross River");
INSERT INTO `STATE`(stateName) VALUES("Delta");
INSERT INTO `STATE`(stateName) VALUES("Ebonyi");
INSERT INTO `STATE`(stateName) VALUES("Edo");
INSERT INTO `STATE`(stateName) VALUES("Ekiti");
INSERT INTO `STATE`(stateName) VALUES("Enugu");
INSERT INTO `STATE`(stateName) VALUES("Gombe");
INSERT INTO `STATE`(stateName) VALUES("Imo");
INSERT INTO `STATE`(stateName) VALUES("Jigawa");
INSERT INTO `STATE`(stateName) VALUES("Kaduna");
INSERT INTO `STATE`(stateName) VALUES("Kano");
INSERT INTO `STATE`(stateName) VALUES("Katsina");
INSERT INTO `STATE`(stateName) VALUES("Kebbi");
INSERT INTO `STATE`(stateName) VALUES("Kogi");
INSERT INTO `STATE`(stateName) VALUES("Kwara");
INSERT INTO `STATE`(stateName) VALUES("Lagos");
INSERT INTO `STATE`(stateName) VALUES("Nasarawa");
INSERT INTO `STATE`(stateName) VALUES("Niger");
INSERT INTO `STATE`(stateName) VALUES("Ogun");
INSERT INTO `STATE`(stateName) VALUES("Ondo");
INSERT INTO `STATE`(stateName) VALUES("Osun");
INSERT INTO `STATE`(stateName) VALUES("Oyo");
INSERT INTO `STATE`(stateName) VALUES("Plateu");
INSERT INTO `STATE`(stateName) VALUES("Rivers");
INSERT INTO `STATE`(stateName) VALUES("Sokoto");
INSERT INTO `STATE`(stateName) VALUES("Taraba");
INSERT INTO `STATE`(stateName) VALUES("Yobe");
INSERT INTO `STATE`(stateName) VALUES("Zamfara");
INSERT INTO `STATE`(stateName) VALUES("FCT Abuja");

DROP TABLE IF EXISTS `LOCALGOV`;
CREATE TABLE `LOCALGOV`(
	localGovId INT NOT NULL AUTO_INCREMENT,
	stateId INT NOT NULL,
	localGovName CHAR(50) NOT NULL,
	PRIMARY KEY(localGovId),
	FOREIGN KEY(stateId) REFERENCES `STATE`(stateId)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Abba North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Abba South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Arochukwu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Bende");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ikwuano");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Isiala-Ngwa North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Isiala-Ngwa South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Isuikwuato");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Obi Nwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ohafia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Osisioma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ngwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ugwunagbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ukwa East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Ukwa West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Umuahia North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Umuahia South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(1, "Umu-Neochi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Demsa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Fufore");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Ganaye");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Gireri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Gombi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Guyuk");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Hong");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Jada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Lamurde");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Madagali");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Maiha");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Mayo-Belwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Michika");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Mubi North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Mubi South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Numan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Shelleng");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Song");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Toungo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Yola North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(2, "Yola South");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Abak");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Eastern Obolo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Eket");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Esit Eket");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Essien Udim");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Etim Ekpo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Etinan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ibeno");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ibesikpo Asutan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ibiono Ibom");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ika");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ikono");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ikot Abasi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ikot Ekpene");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ini");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Itu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Mbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Mkpat Enin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Nsit Atai");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Nsit Ibom");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Nsit Ubium");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Obot Akara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Okobo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Onna");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Oron");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Oruk Anam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Udung Uko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Ukunafun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Uruan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Urue-Ofong");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(3, "Uyo");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Aguata");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Anambra East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Anambra West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Anaocha");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Akwa North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Akwa South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Ayamelum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Dunukofia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Ekwusigo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Idemili North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Idemili South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Ihiala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Njikoka");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Nnewi North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Nnewi South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Ogbaru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Onitsa North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Onitsa South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Orumba North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Orumba South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(4, "Oyi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Alkaleri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Bauchi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Bogoro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Damban");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Darazo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Dass");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Ganjuwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Giade");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Itas Gadau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Jamaare");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Katagum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Kirfi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Misau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Ningi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Shira");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Tafawa Balewa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Toro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Warji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(5, "Zaki");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Brass");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Ekeremor");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Kolokuma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Nembe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Ogbia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Sagbama");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Southern Jaw");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(6, "Yenegoa");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Adp");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Agatu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Apa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Buruku");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Gboko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Guma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Gwer East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Gwer West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Katsina Ala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Konshisha");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Kwande");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Logo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Makurdi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Obi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Ogbadibo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Oju");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Okpokwu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Ohimini");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Oturkpo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Tarka");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Ukum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Ushonga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(7, "Vandeikya"); 

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Abadam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Askira");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Bama");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Bayo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Biu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Chibok");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Damboa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Dikwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Gubio");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Guzamala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Gwoza");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Hawul");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Jere");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Kaga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Kala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Konduga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Kukawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Kwaya Kusar");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Mafa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Magumeri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Maiduguri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Marte");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Mobbar");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Monguno");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Ngala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Nganzai");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(8, "Shani");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Akpabuyo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Odukpani");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Akamkpa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Biase");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Abi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Ikom");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Yarkur");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Odubra");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Boki");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Ogoja");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Yala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Obanliku");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Obudu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Calabar South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Etung");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Bekwara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Bakkasi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(9, "Calabar Municipality");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Oshimili");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Aniocha");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Aniocha South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ika South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ika North East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ndoka West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ndoka East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Isoko South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Isoko North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Bomadi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Burutu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ughelli South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ughelli North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ethiope West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ethiope East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Sapele");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Okpe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Warri North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "warri South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Ukwani");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Oshimili North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(10, "Patani");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Afikpo South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Afikpo North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Onitsa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ohaozara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Abakaliki");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ishielu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ikwo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ezza");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ezza South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ohaukwu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ebonyi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(11, "Ivo");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Esan North East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Esan Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Esan West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Egor");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Ukpoba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Etsako Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Igueben");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Oredo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Ovia SouthWest");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Ovia SouthEast");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Orhionwon");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Uhunmwonde");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Etsako East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(12, "Esan South East");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ado");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ekiti East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ekiti West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Emure");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ekiti SouthWest");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ikare");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Irepodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ijero");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ido");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Oye");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ikole");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Moba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Gbonyin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Efon");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ise");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(13, "Ilejemeje");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Enugu South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Igbo Eze South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Enugu North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Nkanu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Udi Agwu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Oji River");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Ezeagu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "IgboEze North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Isi Uzo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Nsukka");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Igbo Ekiti");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Uzu Uwani");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Enugu East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Aninri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Nkanu East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(14, "Udenu");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Akko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Balanga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Billiri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Dukku");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Kaltungo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Kwami");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Shomgom");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Funakaye");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Gombe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Nafada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(15, "Yamaltu");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Abo Mbaise");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ahiazu Mbaise");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ehime Mbano");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ezinihitte");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ideato North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ideato South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ihitte");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ikeduru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Isiala Mbano");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Isu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Mbaitoli");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ngor Okpala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Njaba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Nwangele");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Nkwerre");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Obowo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Oguta");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Ohaji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Okigwe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Orlu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Orsu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Oru East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Oru west");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Owerri Municipal");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Owerri North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(16, "Owerri West");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Auyo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Babura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Birnin Kudu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Biriniwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Buji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Dutse");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Gagarawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Garki");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Gumel");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Guri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Gwaram");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Gwiwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Hadejia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Jahun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Kafin Hausa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Kaugama Kazaure");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Kiri Kasamma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Kiyawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Maigatari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Malam Madori");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Miga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Ringim");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Roni");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Sule Tankarkar");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Taura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(17, "Yankwashi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Birnin Gwari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Chikun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Giwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Igabi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Ikara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Jaba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Jema'a");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kachia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kaduna North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kaduna South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kagarko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kajuru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kaura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kauru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kubau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Kudan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Lere");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Makarfi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Sabon Gari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Sanga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Soba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Zango Kataf");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(18, "Zaria");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Ajingi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Albasu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Bagwai");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Bebeji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Bichi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Bunkure");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Dala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Danbatta");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Dawakin Kudu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Dawakin Tofa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Doguwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Fagge");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Gabasawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Garko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Garum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Mallam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Gaya");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Gezawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Gwale");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Gwarzo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kabo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kano Municipal");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Karaye");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kibiya");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kiru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kumbotso");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kunchi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Kura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Madobi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Makoda");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Minjibir");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Nasarawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Rano");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Rimin Gado");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Rogo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Shanono");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Sumaila");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Takali");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Tarauni");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Tofa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Tsanyawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Tudun Wada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Ungogo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Warawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(19, "Wudil");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Bakori");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Batagarawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Batsari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Baure");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Bindawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Charanchi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Dandume");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Danja");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Dan Musa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Daura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Dutsi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Dutsin Ma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Faskari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Funtua");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Ingawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Jibia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kafur");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kaita");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kankara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kankia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Katsina");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kurfi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Kusada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Mai Adua");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Malumfashi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Mani");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Mashi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Matazu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Musawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Rimi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Sabuwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Safana");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Sandamu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(20, "Zango");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Aleiro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Arewa Dandi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Argungu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Augie");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Bagudo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Birnin Kebbi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Bunza");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Dandi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Fakai");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Gwandu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Jega");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Kalgo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Koko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Maiyama");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Ngaski");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Sakaba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Shanga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Suru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Wasagu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Yauri");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(21, "Zuru");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Adavi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ajaokuta");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ankpa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Bassa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Dekina");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ibaji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Idah");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Igalamela Odolu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ijumu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Kabba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Kogi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Lokoja");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Mopa Murro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ofu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Ogori");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Okehi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Okene");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Olamabolo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Omala");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Yagba East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(22, "Yagba West");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Asa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Baruten");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Edu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Ekiti");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Ifelodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Ilorin East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Ilorin West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Irepodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Isin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Kaiama");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Moro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Offa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Oke Ero");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Oyun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(23, "Pategi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Agege");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ajeromi Ifelodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Alimosho");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Amuwo Odofin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Apapa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Badagry");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Epe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Eti Osa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ibeju");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ifako Ijaye");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ikeja");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ikorodu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Kosofe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Lagos Island");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Lagos Mainland");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Mushin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Ojo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Oshodi Isolo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Shomolu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(24, "Surulere");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Akwanga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Awe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Doma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Karu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Keana");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Keffi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Kokona");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Lafia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Nasarawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Nasarawa Eggon");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Obi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Toto");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(25, "Wamba");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Agaie");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Agwara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Bida");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Borgu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Bosso");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Chanchaga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Edati");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Gbako");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Gurara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Katcha");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Kontagora");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Lapai");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Lavun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Magama");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Mariga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Mashegu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Mokwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Muya");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Pailoro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Rafi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Rijau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Shiroro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Suleja");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Tafa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(26, "Wushishi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Abeokuta North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Abeokuta South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ado Odo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Egbado North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Egbado South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ewekoro South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ifo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ijebu East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ijebu North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ijebu North East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ijebu Ode");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ikenna");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Imeko Afon");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ipokia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Obafemi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Owode");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Ogun Waterside");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Odeda");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Odogbolu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Remo North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(27, "Shagamu");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akoko North East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akoko North West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akoko South Akure East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akoko South West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akure North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Akure South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ese Odo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Idanre");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ifedore");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ilaje");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ile Oluji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Okeigbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Irele");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Odigbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Okiti Pupa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ondo East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ondo West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Ose");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(28, "Owo");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Aiyedade");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Aiyedire");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Atakumuso East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Atakumuso West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Boluwaduro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Boripe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ede North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ede South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Egbedore");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ejigbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ife Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ife East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ife North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ife South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ifedayo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ifelodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ila");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Illesha East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Illesha West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Irepodun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Irewole");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Isokan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Iwo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Obokun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Odo Otin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Ola Oluwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Olorunda");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Oriade");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Orolu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(29, "Osogbo");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Afijio");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Akinyele");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Atiba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Atigbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Egbeda");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibadan Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibadan North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibadan North West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibadan South East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibadan South West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibarapa Central");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibarapa East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ibarapa North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ido");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Irepo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Iseyin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Itesiwaju");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Iwajowa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Kajola");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Lagelu Ogbomosho North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ogbomosho South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ogo Oluwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Olorunsogo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Oluyole");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ona Ara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Orelepe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Ori Ire");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Oyo East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Oyo West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Saki East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Saki West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(30, "Surulere");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Barikin Ladi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Bassa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Bokkos");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Jos East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Jos North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Jos South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Kanam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Kanke");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Langtang North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Langtang South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Mangu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Mikang");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Pankshin");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Quaan Pan");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Riyom");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Shendam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(31, "Wase");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Abua");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Ahoada East");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Ahoada West");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Akuku Toru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Andoni");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Asari Toru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Bonny");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Degema");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Emohua");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Eleme");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Etche");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Gokana");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Ikwerre");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Khana");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Obia");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Ogba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Ogu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Okrika");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Omumma");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Opobo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Oyigbo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Portharcourt");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(32, "Tai");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Binji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Bodinga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Dange Shnsi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Gada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Goronyo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Gudu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Gawabawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Illela");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Isa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Kware");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Kebbe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Rabah");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Sabon Birni");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Shagari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Silame");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Sokoto North");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Sokoto South");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Tambuwal");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Tangaza");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Tureta");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Wamako");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Wurno");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(33, "Yabo");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Ardo Kola");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Bali");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Donga");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Gashaka");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Cassol");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Ibi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Jalingo");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Karin Lamido");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Kurmi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Lau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Sardauna");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Takum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Ussa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Wukari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Yorro");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(34, "Zing");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Bade");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Bursari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Damaturu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Fika");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Fune");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Geidam");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Gujba");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Gulani");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Jakusko");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Karasuwa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Karawa");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Machina");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Nangere");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Nguru Potiskum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Tarmua");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Yunusari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(35, "Yusufari");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Anka");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Bakura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Birnin Magaji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Bakkuyum");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Bungudu");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Gummi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Gusau");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Kaura");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Namoda");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Maradun");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Maru");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Shinkafi");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Talata Mafara");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Tsafe");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(36, "Zurmi");

INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Gwagwalada");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Kuje");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Abaji");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Abuja Municipal");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Bwari");
INSERT INTO `LOCALGOV`(stateId, localGovName) VALUES(37, "Kwali");

-- Create Registration Area Table --
DROP TABLE IF EXISTS `REGISTRATIONAREA`;
CREATE TABLE `REGISTRATIONAREA` (
    raId INT NOT NULL AUTO_INCREMENT,
    raName VARCHAR(100) NOT NULL,
    localGovId INT NOT NULL,
    PRIMARY KEY(raId),
    FOREIGN KEY(localGovId) REFERENCES LOCALGOV(localGovId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create Polling Unit Table --
DROP TABLE IF EXISTS `POLLINGUNIT`;
CREATE TABLE `POLLINGUNIT` (
    puId INT NOT NULL AUTO_INCREMENT,
    puCode CHAR(50) NOT NULL,
    puDesc VARCHAR(255) NOT NULL,
    raId INT NOT NULL,
    PRIMARY KEY(puId),
    FOREIGN KEY(raId) REFERENCES REGISTRATIONAREA(raId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create Election Type Table --
DROP TABLE IF EXISTS `ELECTIONTYPE`;
CREATE TABLE `ELECTIONTYPE` (
    typeId INT NOT NULL AUTO_INCREMENT,
    typeName CHAR(50) NOT NULL,
    PRIMARY KEY(typeId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

INSERT INTO ELECTIONTYPE(typeName) VALUES('Gubernatorial'), ('Presidential');

-- Create Election Table --
DROP TABLE IF EXISTS `ELECTION`;
CREATE TABLE `ELECTION` (
    electionId INT NOT NULL AUTO_INCREMENT,
    title CHAR(255) NOT NULL,
    `type` INT NOT NULL,
    stateId INT NOT NULL,
    registeredVoters INT,
    accreditedVoters INT,
    votesCast INT,
    validVotes INT,
    rejectedVotes INT,
    `date` TIMESTAMP NOT NULL,
    dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    hashtag VARCHAR(255),
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(electionId),
    FOREIGN KEY(`type`) REFERENCES ELECTIONTYPE(`typeId`),
    FOREIGN KEY(`stateId`) REFERENCES `STATE`(stateId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create Project Timeline Table --
DROP TABLE IF EXISTS `ELECTIONUPDATE`;
CREATE TABLE `ELECTIONUPDATE` (
    updateId INT NOT NULL AUTO_INCREMENT,
    electionId INT NOT NULL,
    title VARCHAR(140) NOT NULL,
    description VARCHAR(255) NOT NULL,
    dateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(updateId),
    FOREIGN KEY(electionId) REFERENCES `ELECTION`(electionId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create Political Party Table --
DROP TABLE IF EXISTS `POLITICALPARTY`;
CREATE TABLE `POLITICALPARTY` (
    partyId INT NOT NULL AUTO_INCREMENT, 
    initials CHAR(10) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(partyId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create Candidate Table --
DROP TABLE IF EXISTS `CANDIDATE`;
CREATE TABLE `CANDIDATE` (
    partyId INT NOT NULL,
    electionId INT NOT NULL,
    aspirant CHAR(200) NOT NULL,
    deputy CHAR(200) NOT NULL,
    gender CHAR(50) NOT NULL,
    age INT NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(partyId, electionId),
    FOREIGN KEY(partyId) REFERENCES POLITICALPARTY(partyId),
    FOREIGN KEY(electionId) REFERENCES ELECTION(electionId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create PU Result Table --
DROP TABLE IF EXISTS `RESULTPU`;
CREATE TABLE `RESULTPU` (
    partyId INT NOT NULL,
    electionId INT NOT NULL,
    puId INT NOT NULL,
    votes INT NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(partyId, electionId, puId),
    FOREIGN KEY(partyId) REFERENCES POLITICALPARTY(partyId),
    FOREIGN KEY(electionId) REFERENCES ELECTION(electionId),
    FOREIGN KEY(puId) REFERENCES POLLINGUNIT(puId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create RA Result Table --
DROP TABLE IF EXISTS `RESULTRA`;
CREATE TABLE `RESULTRA` (
    partyId INT NOT NULL,
    electionId INT NOT NULL,
    raId INT NOT NULL,
    votes INT NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(partyId, electionId, raId),
    FOREIGN KEY(partyId) REFERENCES POLITICALPARTY(partyId),
    FOREIGN KEY(electionId) REFERENCES ELECTION(electionId),
    FOREIGN KEY(raId) REFERENCES REGISTRATIONAREA(raId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Create LGA Result Table --
DROP TABLE IF EXISTS `RESULTLG`;
CREATE TABLE `RESULTLG` (
    partyId INT NOT NULL,
    electionId INT NOT NULL,
    localGovId INT NOT NULL,
    votes INT NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    addedBy CHAR(8) NOT NULL,
    PRIMARY KEY(partyId, electionId, localGovId),
    FOREIGN KEY(partyId) REFERENCES POLITICALPARTY(partyId),
    FOREIGN KEY(electionId) REFERENCES ELECTION(electionId),
    FOREIGN KEY(localGovId) REFERENCES LOCALGOV(localGovId),
    FOREIGN KEY(addedBy) REFERENCES `MODERATOR`(moderatorId)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;