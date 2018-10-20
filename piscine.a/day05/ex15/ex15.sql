SELECT
REVERSE(SUBSTRING(db_aaiche.distrib.telephone, 2)) AS 'enohpelet'
FROM
db_aaiche.distrib
WHERE
db_aaiche.distrib.telephone LIKE '05%';
