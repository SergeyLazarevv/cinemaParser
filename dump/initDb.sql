GRANT ALL PRIVILEGES ON DATABASE test TO test;

CREATE TABLE IF NOT EXISTS films( 
    id SERIAL PRIMARY KEY, 
    name VARCHAR(200) NOT NULL, 
    rating FLOAT NOT NULL,
    year INT NOT NULL,
    rating_vote_count INT NOT NULL,
    poster_url VARCHAR(200),
    poster_url_preview VARCHAR(200)
);
