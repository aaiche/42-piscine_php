SELECT COUNT(*) AS 'nb_susc',
FLOOR(AVG(db_aaiche.subscription.price)) AS 'av_susc',
(SUM(db_aaiche.subscription.duration_sub) MOD 42) AS 'ft'
FROM db_aaiche.subscription;
