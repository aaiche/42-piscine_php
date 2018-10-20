SELECT
db_aaiche.user_card.last_name,
db_aaiche.user_card.first_name
FROM
db_aaiche.user_card
WHERE
db_aaiche.user_card.last_name LIKE '%-%' OR db_aaiche.user_card.first_name LIKE '%-%'
ORDER BY db_aaiche.user_card.last_name, db_aaiche.user_card.first_name;
