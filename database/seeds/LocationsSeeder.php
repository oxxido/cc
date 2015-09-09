<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::unprepared(file_get_contents(base_path() . "/database/sql/cities.sql"));
            DB::table('countries')->delete();
            DB::unprepared($this->countries());
            $this->states();
             DB::table('cities')->delete();
            DB::unprepared($this->cities());
            Schema::dropIfExists('zipcodes');
        });
    }

    private function countries()
    {
        $sql = "
			INSERT INTO countries (id, name, code) VALUES (1,'Andorra','AD');
			INSERT INTO countries (id, name, code) VALUES (2,'United Arab Emirates','AE');
			INSERT INTO countries (id, name, code) VALUES (3,'Afghanistan','AF');
			INSERT INTO countries (id, name, code) VALUES (4,'Antigua and Barbuda','AG');
			INSERT INTO countries (id, name, code) VALUES (5,'Anguilla','AI');
			INSERT INTO countries (id, name, code) VALUES (6,'Albania','AL');
			INSERT INTO countries (id, name, code) VALUES (7,'Armenia','AM');
			INSERT INTO countries (id, name, code) VALUES (8,'Angola','AO');
			INSERT INTO countries (id, name, code) VALUES (9,'Antarctica','AQ');
			INSERT INTO countries (id, name, code) VALUES (10,'Argentina','AR');
			INSERT INTO countries (id, name, code) VALUES (11,'American Samoa','AS');
			INSERT INTO countries (id, name, code) VALUES (12,'Austria','AT');
			INSERT INTO countries (id, name, code) VALUES (13,'Australia','AU');
			INSERT INTO countries (id, name, code) VALUES (14,'Aruba','AW');
			INSERT INTO countries (id, name, code) VALUES (15,'Åland Islands','AX');
			INSERT INTO countries (id, name, code) VALUES (16,'Azerbaijan','AZ');
			INSERT INTO countries (id, name, code) VALUES (17,'Bosnia and Herzegovina','BA');
			INSERT INTO countries (id, name, code) VALUES (18,'Barbados','BB');
			INSERT INTO countries (id, name, code) VALUES (19,'Bangladesh','BD');
			INSERT INTO countries (id, name, code) VALUES (20,'Belgium','BE');
			INSERT INTO countries (id, name, code) VALUES (21,'Burkina Faso','BF');
			INSERT INTO countries (id, name, code) VALUES (22,'Bulgaria','BG');
			INSERT INTO countries (id, name, code) VALUES (23,'Bahrain','BH');
			INSERT INTO countries (id, name, code) VALUES (24,'Burundi','BI');
			INSERT INTO countries (id, name, code) VALUES (25,'Benin','BJ');
			INSERT INTO countries (id, name, code) VALUES (26,'Saint Barthélemy','BL');
			INSERT INTO countries (id, name, code) VALUES (27,'Bermuda','BM');
			INSERT INTO countries (id, name, code) VALUES (28,'Brunei Darussalam','BN');
			INSERT INTO countries (id, name, code) VALUES (29,'Bolivia','BO');
			INSERT INTO countries (id, name, code) VALUES (30,'Caribbean Netherlands ','BQ');
			INSERT INTO countries (id, name, code) VALUES (31,'Brazil','BR');
			INSERT INTO countries (id, name, code) VALUES (32,'Bahamas','BS');
			INSERT INTO countries (id, name, code) VALUES (33,'Bhutan','BT');
			INSERT INTO countries (id, name, code) VALUES (34,'Bouvet Island','BV');
			INSERT INTO countries (id, name, code) VALUES (35,'Botswana','BW');
			INSERT INTO countries (id, name, code) VALUES (36,'Belarus','BY');
			INSERT INTO countries (id, name, code) VALUES (37,'Belize','BZ');
			INSERT INTO countries (id, name, code) VALUES (38,'Canada','CA');
			INSERT INTO countries (id, name, code) VALUES (39,'Cocos (Keeling) Islands','CC');
			INSERT INTO countries (id, name, code) VALUES (40,'Congo, Democratic Republic of','CD');
			INSERT INTO countries (id, name, code) VALUES (41,'Central African Republic','CF');
			INSERT INTO countries (id, name, code) VALUES (42,'Congo','CG');
			INSERT INTO countries (id, name, code) VALUES (43,'Switzerland','CH');
			INSERT INTO countries (id, name, code) VALUES (44,'Côte d\'Ivoire','CI');
			INSERT INTO countries (id, name, code) VALUES (45,'Cook Islands','CK');
			INSERT INTO countries (id, name, code) VALUES (46,'Chile','CL');
			INSERT INTO countries (id, name, code) VALUES (47,'Cameroon','CM');
			INSERT INTO countries (id, name, code) VALUES (48,'China','CN');
			INSERT INTO countries (id, name, code) VALUES (49,'Colombia','CO');
			INSERT INTO countries (id, name, code) VALUES (50,'Costa Rica','CR');
			INSERT INTO countries (id, name, code) VALUES (51,'Cuba','CU');
			INSERT INTO countries (id, name, code) VALUES (52,'Cape Verde','CV');
			INSERT INTO countries (id, name, code) VALUES (53,'Curaçao','CW');
			INSERT INTO countries (id, name, code) VALUES (54,'Christmas Island','CX');
			INSERT INTO countries (id, name, code) VALUES (55,'Cyprus','CY');
			INSERT INTO countries (id, name, code) VALUES (56,'Czech Republic','CZ');
			INSERT INTO countries (id, name, code) VALUES (57,'Germany','DE');
			INSERT INTO countries (id, name, code) VALUES (58,'Djibouti','DJ');
			INSERT INTO countries (id, name, code) VALUES (59,'Denmark','DK');
			INSERT INTO countries (id, name, code) VALUES (60,'Dominica','DM');
			INSERT INTO countries (id, name, code) VALUES (61,'Dominican Republic','DO');
			INSERT INTO countries (id, name, code) VALUES (62,'Algeria','DZ');
			INSERT INTO countries (id, name, code) VALUES (63,'Ecuador','EC');
			INSERT INTO countries (id, name, code) VALUES (64,'Estonia','EE');
			INSERT INTO countries (id, name, code) VALUES (65,'Egypt','EG');
			INSERT INTO countries (id, name, code) VALUES (66,'Western Sahara','EH');
			INSERT INTO countries (id, name, code) VALUES (67,'Eritrea','ER');
			INSERT INTO countries (id, name, code) VALUES (68,'Spain','ES');
			INSERT INTO countries (id, name, code) VALUES (69,'Ethiopia','ET');
			INSERT INTO countries (id, name, code) VALUES (70,'Finland','FI');
			INSERT INTO countries (id, name, code) VALUES (71,'Fiji','FJ');
			INSERT INTO countries (id, name, code) VALUES (72,'Falkland Islands','FK');
			INSERT INTO countries (id, name, code) VALUES (73,'Micronesia, Federated States of','FM');
			INSERT INTO countries (id, name, code) VALUES (74,'Faroe Islands','FO');
			INSERT INTO countries (id, name, code) VALUES (75,'France','FR');
			INSERT INTO countries (id, name, code) VALUES (76,'Gabon','GA');
			INSERT INTO countries (id, name, code) VALUES (77,'United Kingdom','GB');
			INSERT INTO countries (id, name, code) VALUES (78,'Grenada','GD');
			INSERT INTO countries (id, name, code) VALUES (79,'Georgia','GE');
			INSERT INTO countries (id, name, code) VALUES (80,'French Guiana','GF');
			INSERT INTO countries (id, name, code) VALUES (81,'Guernsey','GG');
			INSERT INTO countries (id, name, code) VALUES (82,'Ghana','GH');
			INSERT INTO countries (id, name, code) VALUES (83,'Gibraltar','GI');
			INSERT INTO countries (id, name, code) VALUES (84,'Greenland','GL');
			INSERT INTO countries (id, name, code) VALUES (85,'Gambia','GM');
			INSERT INTO countries (id, name, code) VALUES (86,'Guinea','GN');
			INSERT INTO countries (id, name, code) VALUES (87,'Guadeloupe','GP');
			INSERT INTO countries (id, name, code) VALUES (88,'Equatorial Guinea','GQ');
			INSERT INTO countries (id, name, code) VALUES (89,'Greece','GR');
			INSERT INTO countries (id, name, code) VALUES (90,'South Georgia and the South Sandwich Islands','GS');
			INSERT INTO countries (id, name, code) VALUES (91,'Guatemala','GT');
			INSERT INTO countries (id, name, code) VALUES (92,'Guam','GU');
			INSERT INTO countries (id, name, code) VALUES (93,'Guinea-Bissau','GW');
			INSERT INTO countries (id, name, code) VALUES (94,'Guyana','GY');
			INSERT INTO countries (id, name, code) VALUES (95,'Hong Kong','HK');
			INSERT INTO countries (id, name, code) VALUES (96,'Heard and McDonald Islands','HM');
			INSERT INTO countries (id, name, code) VALUES (97,'Honduras','HN');
			INSERT INTO countries (id, name, code) VALUES (98,'Croatia','HR');
			INSERT INTO countries (id, name, code) VALUES (99,'Haiti','HT');
			INSERT INTO countries (id, name, code) VALUES (100,'Hungary','HU');
			INSERT INTO countries (id, name, code) VALUES (101,'Indonesia','ID');
			INSERT INTO countries (id, name, code) VALUES (102,'Ireland','IE');
			INSERT INTO countries (id, name, code) VALUES (103,'Israel','IL');
			INSERT INTO countries (id, name, code) VALUES (104,'Isle of Man','IM');
			INSERT INTO countries (id, name, code) VALUES (105,'India','IN');
			INSERT INTO countries (id, name, code) VALUES (106,'British Indian Ocean Territory','IO');
			INSERT INTO countries (id, name, code) VALUES (107,'Iraq','IQ');
			INSERT INTO countries (id, name, code) VALUES (108,'Iran','IR');
			INSERT INTO countries (id, name, code) VALUES (109,'Iceland','IS');
			INSERT INTO countries (id, name, code) VALUES (110,'Italy','IT');
			INSERT INTO countries (id, name, code) VALUES (111,'Jersey','JE');
			INSERT INTO countries (id, name, code) VALUES (112,'Jamaica','JM');
			INSERT INTO countries (id, name, code) VALUES (113,'Jordan','JO');
			INSERT INTO countries (id, name, code) VALUES (114,'Japan','JP');
			INSERT INTO countries (id, name, code) VALUES (115,'Kenya','KE');
			INSERT INTO countries (id, name, code) VALUES (116,'Kyrgyzstan','KG');
			INSERT INTO countries (id, name, code) VALUES (117,'Cambodia','KH');
			INSERT INTO countries (id, name, code) VALUES (118,'Kiribati','KI');
			INSERT INTO countries (id, name, code) VALUES (119,'Comoros','KM');
			INSERT INTO countries (id, name, code) VALUES (120,'Saint Kitts and Nevis','KN');
			INSERT INTO countries (id, name, code) VALUES (121,'North Korea','KP');
			INSERT INTO countries (id, name, code) VALUES (122,'South Korea','KR');
			INSERT INTO countries (id, name, code) VALUES (123,'Kuwait','KW');
			INSERT INTO countries (id, name, code) VALUES (124,'Cayman Islands','KY');
			INSERT INTO countries (id, name, code) VALUES (125,'Kazakhstan','KZ');
			INSERT INTO countries (id, name, code) VALUES (126,'Lao People\'s Democratic Republic','LA');
			INSERT INTO countries (id, name, code) VALUES (127,'Lebanon','LB');
			INSERT INTO countries (id, name, code) VALUES (128,'Saint Lucia','LC');
			INSERT INTO countries (id, name, code) VALUES (129,'Liechtenstein','LI');
			INSERT INTO countries (id, name, code) VALUES (130,'Sri Lanka','LK');
			INSERT INTO countries (id, name, code) VALUES (131,'Liberia','LR');
			INSERT INTO countries (id, name, code) VALUES (132,'Lesotho','LS');
			INSERT INTO countries (id, name, code) VALUES (133,'Lithuania','LT');
			INSERT INTO countries (id, name, code) VALUES (134,'Luxembourg','LU');
			INSERT INTO countries (id, name, code) VALUES (135,'Latvia','LV');
			INSERT INTO countries (id, name, code) VALUES (136,'Libya','LY');
			INSERT INTO countries (id, name, code) VALUES (137,'Morocco','MA');
			INSERT INTO countries (id, name, code) VALUES (138,'Monaco','MC');
			INSERT INTO countries (id, name, code) VALUES (139,'Moldova','MD');
			INSERT INTO countries (id, name, code) VALUES (140,'Montenegro','ME');
			INSERT INTO countries (id, name, code) VALUES (141,'Saint-Martin (France)','MF');
			INSERT INTO countries (id, name, code) VALUES (142,'Madagascar','MG');
			INSERT INTO countries (id, name, code) VALUES (143,'Marshall Islands','MH');
			INSERT INTO countries (id, name, code) VALUES (144,'Macedonia','MK');
			INSERT INTO countries (id, name, code) VALUES (145,'Mali','ML');
			INSERT INTO countries (id, name, code) VALUES (146,'Myanmar','MM');
			INSERT INTO countries (id, name, code) VALUES (147,'Mongolia','MN');
			INSERT INTO countries (id, name, code) VALUES (148,'Macau','MO');
			INSERT INTO countries (id, name, code) VALUES (149,'Northern Mariana Islands','MP');
			INSERT INTO countries (id, name, code) VALUES (150,'Martinique','MQ');
			INSERT INTO countries (id, name, code) VALUES (151,'Mauritania','MR');
			INSERT INTO countries (id, name, code) VALUES (152,'Montserrat','MS');
			INSERT INTO countries (id, name, code) VALUES (153,'Malta','MT');
			INSERT INTO countries (id, name, code) VALUES (154,'Mauritius','MU');
			INSERT INTO countries (id, name, code) VALUES (155,'Maldives','MV');
			INSERT INTO countries (id, name, code) VALUES (156,'Malawi','MW');
			INSERT INTO countries (id, name, code) VALUES (157,'Mexico','MX');
			INSERT INTO countries (id, name, code) VALUES (158,'Malaysia','MY');
			INSERT INTO countries (id, name, code) VALUES (159,'Mozambique','MZ');
			INSERT INTO countries (id, name, code) VALUES (160,'Namibia','NA');
			INSERT INTO countries (id, name, code) VALUES (161,'New Caledonia','NC');
			INSERT INTO countries (id, name, code) VALUES (162,'Niger','NE');
			INSERT INTO countries (id, name, code) VALUES (163,'Norfolk Island','NF');
			INSERT INTO countries (id, name, code) VALUES (164,'Nigeria','NG');
			INSERT INTO countries (id, name, code) VALUES (165,'Nicaragua','NI');
			INSERT INTO countries (id, name, code) VALUES (166,'The Netherlands','NL');
			INSERT INTO countries (id, name, code) VALUES (167,'Norway','NO');
			INSERT INTO countries (id, name, code) VALUES (168,'Nepal','NP');
			INSERT INTO countries (id, name, code) VALUES (169,'Nauru','NR');
			INSERT INTO countries (id, name, code) VALUES (170,'Niue','NU');
			INSERT INTO countries (id, name, code) VALUES (171,'New Zealand','NZ');
			INSERT INTO countries (id, name, code) VALUES (172,'Oman','OM');
			INSERT INTO countries (id, name, code) VALUES (173,'Panama','PA');
			INSERT INTO countries (id, name, code) VALUES (174,'Peru','PE');
			INSERT INTO countries (id, name, code) VALUES (175,'French Polynesia','PF');
			INSERT INTO countries (id, name, code) VALUES (176,'Papua New Guinea','PG');
			INSERT INTO countries (id, name, code) VALUES (177,'Philippines','PH');
			INSERT INTO countries (id, name, code) VALUES (178,'Pakistan','PK');
			INSERT INTO countries (id, name, code) VALUES (179,'Poland','PL');
			INSERT INTO countries (id, name, code) VALUES (180,'St. Pierre and Miquelon','PM');
			INSERT INTO countries (id, name, code) VALUES (181,'Pitcairn','PN');
			INSERT INTO countries (id, name, code) VALUES (182,'Puerto Rico','PR');
			INSERT INTO countries (id, name, code) VALUES (183,'Palestine, State of','PS');
			INSERT INTO countries (id, name, code) VALUES (184,'Portugal','PT');
			INSERT INTO countries (id, name, code) VALUES (185,'Palau','PW');
			INSERT INTO countries (id, name, code) VALUES (186,'Paraguay','PY');
			INSERT INTO countries (id, name, code) VALUES (187,'Qatar','QA');
			INSERT INTO countries (id, name, code) VALUES (188,'Réunion','RE');
			INSERT INTO countries (id, name, code) VALUES (189,'Romania','RO');
			INSERT INTO countries (id, name, code) VALUES (190,'Serbia','RS');
			INSERT INTO countries (id, name, code) VALUES (191,'Russian Federation','RU');
			INSERT INTO countries (id, name, code) VALUES (192,'Rwanda','RW');
			INSERT INTO countries (id, name, code) VALUES (193,'Saudi Arabia','SA');
			INSERT INTO countries (id, name, code) VALUES (194,'Solomon Islands','SB');
			INSERT INTO countries (id, name, code) VALUES (195,'Seychelles','SC');
			INSERT INTO countries (id, name, code) VALUES (196,'Sudan','SD');
			INSERT INTO countries (id, name, code) VALUES (197,'Sweden','SE');
			INSERT INTO countries (id, name, code) VALUES (198,'Singapore','SG');
			INSERT INTO countries (id, name, code) VALUES (199,'Saint Helena','SH');
			INSERT INTO countries (id, name, code) VALUES (200,'Slovenia','SI');
			INSERT INTO countries (id, name, code) VALUES (201,'Svalbard and Jan Mayen Islands','SJ');
			INSERT INTO countries (id, name, code) VALUES (202,'Slovakia','SK');
			INSERT INTO countries (id, name, code) VALUES (203,'Sierra Leone','SL');
			INSERT INTO countries (id, name, code) VALUES (204,'San Marino','SM');
			INSERT INTO countries (id, name, code) VALUES (205,'Senegal','SN');
			INSERT INTO countries (id, name, code) VALUES (206,'Somalia','SO');
			INSERT INTO countries (id, name, code) VALUES (207,'Suriname','SR');
			INSERT INTO countries (id, name, code) VALUES (208,'South Sudan','SS');
			INSERT INTO countries (id, name, code) VALUES (209,'Sao Tome and Principe','ST');
			INSERT INTO countries (id, name, code) VALUES (210,'El Salvador','SV');
			INSERT INTO countries (id, name, code) VALUES (211,'Sint Maarten (Dutch part)','SX');
			INSERT INTO countries (id, name, code) VALUES (212,'Syria','SY');
			INSERT INTO countries (id, name, code) VALUES (213,'Swaziland','SZ');
			INSERT INTO countries (id, name, code) VALUES (214,'Turks and Caicos Islands','TC');
			INSERT INTO countries (id, name, code) VALUES (215,'Chad','TD');
			INSERT INTO countries (id, name, code) VALUES (216,'French Southern Territories','TF');
			INSERT INTO countries (id, name, code) VALUES (217,'Togo','TG');
			INSERT INTO countries (id, name, code) VALUES (218,'Thailand','TH');
			INSERT INTO countries (id, name, code) VALUES (219,'Tajikistan','TJ');
			INSERT INTO countries (id, name, code) VALUES (220,'Tokelau','TK');
			INSERT INTO countries (id, name, code) VALUES (221,'Timor-Leste','TL');
			INSERT INTO countries (id, name, code) VALUES (222,'Turkmenistan','TM');
			INSERT INTO countries (id, name, code) VALUES (223,'Tunisia','TN');
			INSERT INTO countries (id, name, code) VALUES (224,'Tonga','TO');
			INSERT INTO countries (id, name, code) VALUES (225,'Turkey','TR');
			INSERT INTO countries (id, name, code) VALUES (226,'Trinidad and Tobago','TT');
			INSERT INTO countries (id, name, code) VALUES (227,'Tuvalu','TV');
			INSERT INTO countries (id, name, code) VALUES (228,'Taiwan','TW');
			INSERT INTO countries (id, name, code) VALUES (229,'Tanzania','TZ');
			INSERT INTO countries (id, name, code) VALUES (230,'Ukraine','UA');
			INSERT INTO countries (id, name, code) VALUES (231,'Uganda','UG');
			INSERT INTO countries (id, name, code) VALUES (232,'United States Minor Outlying Islands','UM');
			INSERT INTO countries (id, name, code) VALUES (233,'United States','US');
			INSERT INTO countries (id, name, code) VALUES (234,'Uruguay','UY');
			INSERT INTO countries (id, name, code) VALUES (235,'Uzbekistan','UZ');
			INSERT INTO countries (id, name, code) VALUES (236,'Vatican','VA');
			INSERT INTO countries (id, name, code) VALUES (237,'Saint Vincent and the Grenadines','VC');
			INSERT INTO countries (id, name, code) VALUES (238,'Venezuela','VE');
			INSERT INTO countries (id, name, code) VALUES (239,'Virgin Islands (British)','VG');
			INSERT INTO countries (id, name, code) VALUES (240,'Virgin Islands (U.S.)','VI');
			INSERT INTO countries (id, name, code) VALUES (241,'Vietnam','VN');
			INSERT INTO countries (id, name, code) VALUES (242,'Vanuatu','VU');
			INSERT INTO countries (id, name, code) VALUES (243,'Wallis and Futuna Islands','WF');
			INSERT INTO countries (id, name, code) VALUES (244,'Samoa','WS');
			INSERT INTO countries (id, name, code) VALUES (245,'Yemen','YE');
			INSERT INTO countries (id, name, code) VALUES (246,'Mayotte','YT');
			INSERT INTO countries (id, name, code) VALUES (247,'South Africa','ZA');
			INSERT INTO countries (id, name, code) VALUES (248,'Zambia','ZM');
			INSERT INTO countries (id, name, code) VALUES (249,'Zimbabwe','ZW');
		";

        return $sql;
    }

    private function states()
    {

        $country_id = DB::table('countries')->where('code', 'US')->first()->id;

        //delete types table records
        DB::table('states')->delete();

        //insert records
        DB::table('states')->insert([
            ['code' => 'AL', 'country_id' => $country_id, 'name' => 'Alabama'],
            ['code' => 'AK', 'country_id' => $country_id, 'name' => 'Alaska'],
            ['code' => 'AS', 'country_id' => $country_id, 'name' => 'American Samoa'],
            ['code' => 'AZ', 'country_id' => $country_id, 'name' => 'Arizona'],
            ['code' => 'AR', 'country_id' => $country_id, 'name' => 'Arkansas'],
            ['code' => 'CA', 'country_id' => $country_id, 'name' => 'California'],
            ['code' => 'CO', 'country_id' => $country_id, 'name' => 'Colorado'],
            ['code' => 'CT', 'country_id' => $country_id, 'name' => 'Connecticut'],
            ['code' => 'DE', 'country_id' => $country_id, 'name' => 'Delaware'],
            ['code' => 'DC', 'country_id' => $country_id, 'name' => 'District Of Columbia'],
            ['code' => 'FM', 'country_id' => $country_id, 'name' => 'Federated States Of Micronesia'],
            ['code' => 'FL', 'country_id' => $country_id, 'name' => 'Florida'],
            ['code' => 'GA', 'country_id' => $country_id, 'name' => 'Georgia'],
            ['code' => 'GU', 'country_id' => $country_id, 'name' => 'Guam'],
            ['code' => 'HI', 'country_id' => $country_id, 'name' => 'Hawaii'],
            ['code' => 'ID', 'country_id' => $country_id, 'name' => 'Idaho'],
            ['code' => 'IL', 'country_id' => $country_id, 'name' => 'Illinois'],
            ['code' => 'IN', 'country_id' => $country_id, 'name' => 'Indiana'],
            ['code' => 'IA', 'country_id' => $country_id, 'name' => 'Iowa'],
            ['code' => 'KS', 'country_id' => $country_id, 'name' => 'Kansas'],
            ['code' => 'KY', 'country_id' => $country_id, 'name' => 'Kentucky'],
            ['code' => 'LA', 'country_id' => $country_id, 'name' => 'Louisiana'],
            ['code' => 'ME', 'country_id' => $country_id, 'name' => 'Maine'],
            ['code' => 'MH', 'country_id' => $country_id, 'name' => 'Marshall Islands'],
            ['code' => 'MD', 'country_id' => $country_id, 'name' => 'Maryland'],
            ['code' => 'MA', 'country_id' => $country_id, 'name' => 'Massachusetts'],
            ['code' => 'MI', 'country_id' => $country_id, 'name' => 'Michigan'],
            ['code' => 'MN', 'country_id' => $country_id, 'name' => 'Minnesota'],
            ['code' => 'MS', 'country_id' => $country_id, 'name' => 'Mississippi'],
            ['code' => 'MO', 'country_id' => $country_id, 'name' => 'Missouri'],
            ['code' => 'MT', 'country_id' => $country_id, 'name' => 'Montana'],
            ['code' => 'NE', 'country_id' => $country_id, 'name' => 'Nebraska'],
            ['code' => 'NV', 'country_id' => $country_id, 'name' => 'Nevada'],
            ['code' => 'NH', 'country_id' => $country_id, 'name' => 'New Hampshire'],
            ['code' => 'NJ', 'country_id' => $country_id, 'name' => 'New Jersey'],
            ['code' => 'NM', 'country_id' => $country_id, 'name' => 'New Mexico'],
            ['code' => 'NY', 'country_id' => $country_id, 'name' => 'New York'],
            ['code' => 'NC', 'country_id' => $country_id, 'name' => 'North Carolina'],
            ['code' => 'ND', 'country_id' => $country_id, 'name' => 'North Dakota'],
            ['code' => 'MP', 'country_id' => $country_id, 'name' => 'Northern Mariana Islands'],
            ['code' => 'OH', 'country_id' => $country_id, 'name' => 'Ohio'],
            ['code' => 'OK', 'country_id' => $country_id, 'name' => 'Oklahoma'],
            ['code' => 'OR', 'country_id' => $country_id, 'name' => 'Oregon'],
            ['code' => 'PW', 'country_id' => $country_id, 'name' => 'Palau'],
            ['code' => 'PA', 'country_id' => $country_id, 'name' => 'Pennsylvania'],
            ['code' => 'PR', 'country_id' => $country_id, 'name' => 'Puerto Rico'],
            ['code' => 'RI', 'country_id' => $country_id, 'name' => 'Rhode Island'],
            ['code' => 'SC', 'country_id' => $country_id, 'name' => 'South Carolina'],
            ['code' => 'SD', 'country_id' => $country_id, 'name' => 'South Dakota'],
            ['code' => 'TN', 'country_id' => $country_id, 'name' => 'Tennessee'],
            ['code' => 'TX', 'country_id' => $country_id, 'name' => 'Texas'],
            ['code' => 'UT', 'country_id' => $country_id, 'name' => 'Utah'],
            ['code' => 'VT', 'country_id' => $country_id, 'name' => 'Vermont'],
            ['code' => 'VI', 'country_id' => $country_id, 'name' => 'Virgin Islands'],
            ['code' => 'VA', 'country_id' => $country_id, 'name' => 'Virginia'],
            ['code' => 'WA', 'country_id' => $country_id, 'name' => 'Washington'],
            ['code' => 'WV', 'country_id' => $country_id, 'name' => 'West Virginia'],
            ['code' => 'WI', 'country_id' => $country_id, 'name' => 'Wisconsin'],
            ['code' => 'WY', 'country_id' => $country_id, 'name' => 'Wyoming']
         ]);
    }

    private function cities()
    {
        $sql = "
            INSERT INTO cities (
                SELECT
                    NULL, s.id, z.city, z.zip
                FROM
                    zipcodes AS z
                        INNER JOIN
                    states AS s ON s.code COLLATE utf8_general_ci = z.state COLLATE utf8_general_ci
                        AND s.country_id = 233
            );
        ";

        return $sql;
    }
}
