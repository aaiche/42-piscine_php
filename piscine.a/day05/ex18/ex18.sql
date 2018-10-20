SELECT
db_aaiche.distrib.nom
FROM
db_aaiche.distrib
WHERE
(
	(BINARY(db_aaiche.distrib.nom) REGEXP '[^yY]y{1}[^yY]')
	OR
	(BINARY(db_aaiche.distrib.nom) REGEXP '[^Yy]Y{2}[^Yy]')
)
AND
db_aaiche.distrib.id_distrib IN (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90)
LIMIT 5 OFFSET 2;

