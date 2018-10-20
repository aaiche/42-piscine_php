SELECT count(*) AS 'movies'
FROM db_aaiche.member_history
WHERE ((DATE(db_aaiche.member_history.date) > '2006-10-29' AND DATE(db_aaiche.member_history.date) < '2007-07-28')
OR (MONTH(db_aaiche.member_history.date) = 12 AND DAY(db_aaiche.member_history.date) = 24));
