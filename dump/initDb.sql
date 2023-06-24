GRANT ALL PRIVILEGES ON DATABASE test TO test;

CREATE TABLE IF NOT EXISTS films( 
    id SERIAL PRIMARY KEY, 
    name VARCHAR(200) NOT NULL, 
    rating FLOAT NOT NULL,
    date timestamptz NOT NULL,
    counters INT NOT NULL
);
