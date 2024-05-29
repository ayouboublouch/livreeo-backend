INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES
('Amina Khattabi', 'amina.khattabi@example.com', '2024-01-15 10:00:00', 'hashed_password1', NULL, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Youssef El Ghazi', 'youssef.ghazi@example.com', '2024-01-16 10:00:00', 'hashed_password2', NULL, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Samira Benmoussa', 'samira.benmoussa@example.com', '2024-01-17 10:00:00', 'hashed_password3', NULL, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Karim Abdellaoui', 'karim.abdellaoui@example.com', '2024-01-18 10:00:00', 'hashed_password4', NULL, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Fatima Zahra', 'fatima.zahra@example.com', '2024-01-19 10:00:00', 'hashed_password5', NULL, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO shipping_types (title, description, price, delay, created_at, updated_at) VALUES
('Standard Shipping', 'Delivery within 5-7 business days', 30.00, 7, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Express Shipping', 'Delivery within 2-3 business days', 50.00, 3, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Same Day Delivery', 'Delivery on the same day', 80.00, 1, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Pickup Point', 'Pickup from a local point', 20.00, 5, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Free Shipping', 'Free delivery within 10 business days', 0.00, 10, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO posts (name, contract_type, city_id, created_at, updated_at) VALUES
('First Post', 'CDI', '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Second Post', 'CDD', '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Third Post', 'CDI', '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Fourth Post', 'CDD', '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Fifth Post', 'CDI', '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO files (path, created_at, updated_at) VALUES
('/uploads/file1.pdf', '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('/uploads/file2.pdf', '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('/uploads/file3.pdf', '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('/uploads/file4.pdf', '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('/uploads/file5.pdf', '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO languages (name, created_at, updated_at) VALUES
('Arabic', '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('French', '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('English', '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Spanish', '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Berber', '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO cities (name, country, created_at, updated_at) VALUES
('Casablanca', 'Morocco', '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Rabat', 'Morocco', '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Marrakech', 'Morocco', '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Fes', 'Morocco', '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Tangier', 'Morocco', '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO schools (name, city_id, created_at, updated_at) VALUES
('School 1', 1, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('School 2', 2, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('School 3', 3, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('School 4', 4, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('School 5', 5, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO groups (name, school_id, language_id, created_at, updated_at) VALUES
('Group 1', 1, 1, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Group 2', 2, 2, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Group 3', 3, 3, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Group 4', 4, 4, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Group 5', 5, 5, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO categories (name, created_at, updated_at) VALUES
('Category 1', '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Category 2', '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Category 3', '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Category 4', '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Category 5', '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO articles (name, description, type, price, status, category_id, created_at, updated_at) VALUES
('Article 1', 'Description for article 1', 1, 100.00, 1, 1, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
('Article 2', 'Description for article 2', 2, 200.00, 1, 2, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
('Article 3', 'Description for article 3', 1, 150.00, 1, 3, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
('Article 4', 'Description for article 4', 2, 250.00, 1, 4, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
('Article 5', 'Description for article 5', 1, 300.00, 1, 5, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO variants (article_id, color, image_id, status, created_at, updated_at) VALUES
(1, 'Red', 1, 1, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
(2, 'Blue', 2, 1, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
(3, 'Green', 3, 1, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
(4, 'Yellow', 4, 1, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
(5, 'Black', 5, 1, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO group_languages (group_id, language_id, school_list, created_at, updated_at) VALUES
(1, 1, 1, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
(2, 2, 2, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
(3, 3, 3, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
(4, 4, 4, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
(5, 5, 5, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO group_language_articles (article_id, group_language_id, quantity, created_at, updated_at) VALUES
(1, 1, 10, '2024-01-15 10:00:00', '2024-01-15 10:00:00'),
(2, 2, 20, '2024-01-16 10:00:00', '2024-01-16 10:00:00'),
(3, 3, 30, '2024-01-17 10:00:00', '2024-01-17 10:00:00'),
(4, 4, 40, '2024-01-18 10:00:00', '2024-01-18 10:00:00'),
(5, 5, 50, '2024-01-19 10:00:00', '2024-01-19 10:00:00');

INSERT INTO promo_codes (available_from, available_to, code, reduction_rate, created_at, updated_at) VALUES
('2024-01-01 00:00:00', '2024-01-31 23:59:59', 'PROMO10', 0.1000, '2024-01-01 00:00:00', '2024-01-01 00:00:00'),
('2024-02-01 00:00:00', '2024-02-28 23:59:59', 'PROMO20', 0.2000, '2024-02-01 00:00:00', '2024-02-01 00:00:00'),
('2024-03-01 00:00:00', '2024-03-31 23:59:59', 'PROMO30', 0.3000, '2024-03-01 00:00:00', '2024-03-01 00:00:00'),
('2024-04-01 00:00:00', '2024-04-30 23:59:59', 'PROMO40', 0.4000, '2024-04-01 00:00:00', '2024-04-01 00:00:00'),
('2024-05-01 00:00:00', '2024-05-31 23:59:59', 'PROMO50', 0.5000, '2024-05-01 00:00:00', '2024-05-01 00:00:00');