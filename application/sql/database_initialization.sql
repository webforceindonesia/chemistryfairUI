# Accounts database initialization
INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `is_admin`) 
VALUES (NULL, 'administrator', 'password_cfui2016', 'admin@example.com', '1');

# Indonesia's regions list initialization
INSERT INTO `misc_regions` (`id`, `name`) 
VALUES (NULL, 'aceh'), (NULL, 'bali'), (NULL, 'banten'), 
(NULL, 'bengkulu'), (NULL, 'gorontalo'), (NULL, 'jakarta'), 
(NULL, 'jambi'), (NULL, 'jawa_barat'), (NULL, 'jawa_tengah'), 
(NULL, 'jawa_timur'), (NULL, 'kalimantan_barat'), (NULL, 'kalimantan_selatan'), 
(NULL, 'kalimantan_tengah'), (NULL, 'kalimantan_utara'), (NULL, 'kepulauan_bangka_belitung'), 
(NULL, 'kepulauan_riau'), (NULL, 'lampung'), (NULL, 'maluku'), 
(NULL, 'maluku_utara'), (NULL, 'nusa_tenggara_barat'), (NULL, 'nusa_tenggara_timur'), 
(NULL, 'papua'), (NULL, 'papua_barat'), (NULL, 'riau'), 
(NULL, 'sulawesi_barat'), (NULL, 'sulawesi_selatan'), (NULL, 'sulawesi_tengah'), 
(NULL, 'sulawesi_timur'), (NULL, 'sulawesi_utara'), (NULL, 'sumatera_barat'), 
(NULL, 'sumatera_selatan'), (NULL, 'sumatera_utara'), (NULL, 'yogyakarta'); 

# Chemistry Competition regionsets list initialization
INSERT INTO `cc_regionsets` (`id`) VALUES (NULL), (NULL), (NULL), (NULL), (NULL);
INSERT INTO `cc_regionset_regions` (`id`, `regionset_id`, `region_id`) VALUES
(1, 1, 31),
(2, 1, 32),
(3, 1, 33),
(4, 1, 1),
(5, 1, 4),
(6, 1, 7),
(7, 1, 16),
(8, 1, 17),
(9, 1, 18),
(10, 1, 25),
(11, 2, 3),
(12, 2, 6),
(13, 2, 8),
(14, 3, 9),
(15, 3, 10),
(16, 3, 34),
(17, 3, 2),
(18, 4, 11),
(19, 4, 12),
(20, 4, 13),
(21, 4, 14),
(22, 4, 17),
(23, 4, 26),
(24, 4, 27),
(25, 4, 28),
(26, 4, 29),
(27, 4, 30),
(28, 4, 5),
(29, 5, 23),
(30, 5, 24),
(31, 5, 19),
(32, 5, 20),
(33, 5, 21),
(34, 5, 22);

# Chemistry Competition Phases
INSERT INTO `cc_phases` (`id`, `name`) VALUES 
(NULL, 'pending'), 
(NULL, 'selection'), 
(NULL, 'quarterfinal'), 
(NULL, 'semifinal'), 
(NULL, 'final');

# Chemistry Innovation Project Phases
INSERT INTO `cip_phases` (`id`, `name`) VALUES 
(NULL, 'pending_document'), 
(NULL, 'pending_payment'), 
(NULL, 'submission'), 
(NULL, 'presentation'), 
(NULL, 'display_cip');

