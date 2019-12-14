CREATE VIEW `composer_view` AS
SELECT
	C.comp_id AS `cv_id`,
    CONCAT_WS(' ',comp_fname,comp_mname,comp_lname) AS `cv_name`,
    comp_lname AS `cv_surname`,
    comp_birthyear AS `cv_born`,
	comp_deathyear AS `cv_died`,
    comp_nationality AS `cv_nationality`,
    GROUP_CONCAT(DISTINCT era_name SEPARATOR ', ') AS `cv_era`,
    comp_wiki AS `cv_wiki`,
    comp_imslp AS `cv_imslp`
FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id)
JOIN `era` AS E ON CE.era_id = E.era_id
GROUP BY C.comp_id
;





CREATE VIEW `work_view` AS
SELECT
	w.work_id AS `wv_id`,
    CONCAT_WS(', ',work_title,work_opus,work_identifier,work_mvtitle) AS `wv_title`,
    work_identifier AS `wv_identifier`,
    cv.cv_name AS `wv_composer`,
    cv_id AS `cv_id`,
    work_yearcompleted AS `wv_completed`,
    era_name AS `wv_era`,
    GROUP_CONCAT(DISTINCT key_name SEPARATOR ', ') AS `wv_keys`,
	GROUP_CONCAT(DISTINCT time_name SEPARATOR ', ') AS `wv_times`,
	GROUP_CONCAT(DISTINCT tempo_marking SEPARATOR ', ') AS `wv_tempos`,
	GROUP_CONCAT(DISTINCT instr_name SEPARATOR ', ') AS `wv_instruments`,
    work_wiki AS `wv_wiki`,
    work_imslp AS `wv_imslp`
FROM
	`work` w,
    `era` e,
    `tempo` tp,
    `work_tempo` wtp,
    `time` tm,
    `work_time` wtm,
    `key` k,
    `work_key` wk,
    `instrument` i,
    `work_instrument` wi,
    `composer_view` cv
WHERE
	w.comp_id = cv.cv_id AND
    w.era_id = e.era_id AND
    w.work_id = wtp.work_id AND
    wtp.tempo_id = tp.tempo_id AND
    w.work_id = wtm.work_id AND
    wtm.time_id = tm.time_id AND
    w.work_id = wk.work_id AND
    wk.key_id = k.key_id AND
    w.work_id = wi.work_id AND
    wi.instr_id = i.instr_id
GROUP BY w.work_id
;



-- DROP VIEW composer_view;
-- DROP VIEW work_view;
