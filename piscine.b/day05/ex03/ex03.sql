INSERT INTO db_aaiche.ft_table
  (login, creation_date, `group`)
SELECT last_name, birthdate, 'other' 
FROM db_aaiche.user_card 
WHERE last_name LIKE '%a%' AND CHAR_LENGTH(last_name) < 9 
ORDER BY last_name ASC LIMIT 10;

