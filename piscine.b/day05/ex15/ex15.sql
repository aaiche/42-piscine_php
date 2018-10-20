SELECT
REVERSE(SUBSTRING(db_aaiche.distrib.phone_number, 2)) AS 'enohpelet'
FROM
db_aaiche.distrib
WHERE
db_aaiche.distrib.phone_number LIKE '05%';
