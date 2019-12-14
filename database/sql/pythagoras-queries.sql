-- 1. Show all works that use piano
SELECT
	wv_title AS `Title`,
    wv_composer AS `Composer`,
    wv_instruments AS `Instruments`
FROM `work_view` WHERE wv_instruments LIKE "piano";


-- 2. Show all Czech composers, alphabetized by last name
SELECT
	CONCAT(comp_lname,', ',comp_fname, ' ',comp_mname) AS `Name`,
    comp_nationality AS `Nationality`
FROM composer
WHERE comp_nationality = "Czech"
ORDER BY comp_lname;


-- 3. Show all works written in a compound meter (3/4, 6/8, 9/8, 12/8)
SELECT
	CONCAT(work_title,', ',work_mvtitle) AS `Title`,
	T.time_name as `Time signature`
FROM `work` AS W
JOIN `work_time` AS WT on W.work_id = WT.work_id
JOIN `time` as T on WT.time_id = T.time_id
WHERE time_name in ('3/4','6/8','9/8','12/8')
;


-- 4. Show the number of Dvorak's works written in each key
SELECT
	K.key_name AS `Key signature`,
    COUNT(*) AS `Number of works`
FROM `work` AS W
JOIN `work_key` AS WK ON W.work_id = WK.work_id
JOIN `key` AS K ON WK.key_id = K.key_id
WHERE W.comp_id = (SELECT C.comp_id FROM `composer` AS C WHERE comp_lname = "Dvorak")
GROUP BY K.key_name
;

-- 5. Show all Czech composers born within 40 years of Antonin Dvorak
SELECT
    CONCAT_WS(' ',comp_fname,comp_mname,comp_lname) AS `Name`,
    CONCAT(comp_birthyear,'-',comp_deathyear) AS `Years`,
    comp_nationality AS `Nationality`
FROM `composer`
WHERE
	comp_nationality = 'Czech' AND
    comp_birthyear BETWEEN
        (SELECT comp_birthyear FROM `composer` WHERE comp_lname = "Dvorak") - 40 AND
		(SELECT comp_birthyear FROM `composer` WHERE comp_lname = "Dvorak") + 40
ORDER BY comp_birthyear;


-- 6. Show the tempos of all third movements in Dvorak's works
SELECT
	CONCAT(work_title,', ',work_mvtitle) AS Title,
    work_mvnumber AS `Movement number`,
	CONCAT_WS(' ',comp_fname,comp_mname,comp_lname) AS Composer,
    GROUP_CONCAT(T.tempo_marking SEPARATOR ', ') AS Tempo
FROM `work` AS W
LEFT JOIN `composer` AS C ON W.comp_id = C.comp_id
LEFT JOIN `work_tempo` AS WT on W.work_id = WT.work_id
LEFT JOIN `tempo` AS T on WT.tempo_id = T.tempo_id
WHERE C.comp_lname = "Dvorak" AND W.work_mvnumber = 3
GROUP BY W.work_id
ORDER BY W.work_id;
    

-- 7. Show all Dvorak's works completed while Brahms was writing his Hungarian Dances
SELECT W.work_title AS Title, W.work_yearcompleted AS `Year Completed`
FROM `work` AS W
JOIN `composer` AS C ON W.comp_id = C.comp_id
WHERE
	W.comp_id = (SELECT comp_id FROM `composer` WHERE comp_lname = "Dvorak") AND
    W.work_yearcompleted BETWEEN
		(SELECT MIN(work_yearbegun)
        FROM `work` AS W JOIN `composer` AS C ON W.comp_id = C.comp_id
        WHERE comp_lname = "Brahms") AND
		(SELECT MAX(work_yearcompleted)
        FROM `work` AS W JOIN `composer` AS C ON W.comp_id = C.comp_id
        WHERE comp_lname = "Brahms")
GROUP BY work_title
ORDER BY W.work_yearcompleted
;
