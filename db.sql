CREATE TABLE test(
    id INT(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id)
);

CREATE TABLE users(
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    email varchar(100) NOT NULL,
    username varchar(30) NOT NULL,
    name varchar(30) NOT NULL,
    pwd varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    verified BOOLEAN DEFAULT FALSE NOT NULL,

    links VARCHAR(500) NOT NULL DEFAULT '',
    about_text VARCHAR(500) NOT NULL DEFAULT '',
    birthday DATE DEFAULT NULL,


    PRIMARY KEY(user_id)
);

CREATE TABLE follows(
    user_who_follow INT(11) NOT NULL,
    user_who_is_followed INT(11) NOT NULL,

    UNIQUE(user_who_follow, user_who_is_followed),

    PRIMARY KEY(user_who_follow, user_who_is_followed),
    FOREIGN KEY(user_who_follow) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(user_who_is_followed) REFERENCES users(user_id) ON DELETE CASCADE

);

CREATE TABLE posts(
    post_id INT(11) NOT NULL AUTO_INCREMENT,

    post_text TEXT NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT(11) NOT NULL,
    reposted_from INT(11) DEFAULT NULL,
    
    PRIMARY KEY(post_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(reposted_from) REFERENCES posts(post_id) ON DELETE CASCADE

);

CREATE TABLE likes(
    user_id INT(11) NOT NULL,
    post_id INT(11) NOT NULL,

    UNIQUE(user_id, post_id),

    PRIMARY KEY(user_id, post_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE

);

CREATE TABLE stars(
    user_id INT(11) NOT NULL,
    post_id INT(11) NOT NULL,

    UNIQUE(user_id, post_id),

    PRIMARY KEY(user_id, post_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE

);

CREATE TABLE comments(
    id INT(11) NOT NULL AUTO_INCREMENT,

    comments_text TEXT NOT NULL,
    post_id INT(11) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT(11) NOT NULL,
    
    PRIMARY KEY(id),
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE

);

CREATE TABLE langs(
    lang varchar(30) NOT NULL,
    lang_id INT(11) NOT NULL,
    PRIMARY KEY(lang_id)
);
CREATE TABLE themes(
    theme varchar(30) NOT NULL,
    theme_id INT(11) NOT NULL,
    PRIMARY KEY(theme_id)
);
    INSERT INTO langs (lang, lang_id) VALUES ('Arabic', 1),
    ('English', 2);
    INSERT INTO themes (theme, theme_id) VALUES ('Light', 1),
    ('Dark', 2);
CREATE TABLE settings(
    user_id INT(11) NOT NULL,
    lang_id INT(11) NOT NULL DEFAULT 1,
    theme_id INT(11) NOT NULL DEFAULT 1,

    PRIMARY KEY(user_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(lang_id) REFERENCES langs(lang_id) ON DELETE CASCADE,
    FOREIGN KEY(theme_id) REFERENCES themes(theme_id) ON DELETE CASCADE
);

CREATE TABLE notification(
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    post_id INT(11) DEFAULT NULL,
    notification_text TEXT NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE

);



