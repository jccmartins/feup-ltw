CREATE TABLE user (
  user_id INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL,
  password VARCHAR NOT NULL
);

CREATE TABLE place
(
    place_id INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    pricePerDay INTEGER NOT NULL CHECK(pricePerDay >= 0),
    location TEXT NOT NULL,
    description TEXT NOT NULL,
    user_id INTEGER NOT NULL REFERENCES user
);

CREATE TABLE reservation
(
    reservation_id INTEGER PRIMARY KEY,
    guest_id INTEGER NOT NULL REFERENCES user,
    checkIn DATE NOT NULL,
    checkOut DATE NOT NULL,
    place_id INTEGER NOT NULL REFERENCES place
);

CREATE TABLE photo
(
    photo_id INTEGER PRIMARY KEY,
    url TEXT NOT NULL,
    place_id INTEGER NOT NULL REFERENCES place
);

CREATE TABLE chat (
  id INTEGER PRIMARY KEY,
  date INTEGER NOT NULL,
  username VARCHAR NOT NULL,
  text VARCHAR NOT NULL,
  place_id INTEGER NOT NULL REFERENCES place
);
