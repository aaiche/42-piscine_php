SELECT
MD5(REPLACE(CONCAT(db_aaiche.distrib.telephone, "42"), '7', '9')) AS 'ft5'
FROM
db_aaiche.distrib
WHERE
db_aaiche.distrib.id_distrib=84;

