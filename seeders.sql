INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at)
VALUES
('User1', 'user1@example.com', NOW(), 'password1', 'token1', NOW(), NOW()),
('User2', 'user2@example.com', NOW(), 'password2', 'token2', NOW(), NOW()),
('User3', 'user3@example.com', NOW(), 'password3', 'token3', NOW(), NOW()),
('User4', 'user4@example.com', NOW(), 'password4', 'token4', NOW(), NOW()),
('User5', 'user5@example.com', NOW(), 'password5', 'token5', NOW(), NOW()),
('User6', 'user6@example.com', NOW(), 'password6', 'token6', NOW(), NOW()),
('User7', 'user7@example.com', NOW(), 'password7', 'token7', NOW(), NOW()),
('User8', 'user8@example.com', NOW(), 'password8', 'token8', NOW(), NOW()),
('User9', 'user9@example.com', NOW(), 'password9', 'token9', NOW(), NOW()),
('User10', 'user10@example.com', NOW(), 'password10', 'token10', NOW(), NOW());


INSERT INTO shipping_types (title, description, price, delay, created_at, updated_at)
VALUES
('Standard', 'Standard shipping', 5.00, 7, NOW(), NOW()),
('Express', 'Express shipping', 10.00, 3, NOW(), NOW()),
('Overnight', 'Overnight shipping', 20.00, 1, NOW(), NOW()),
('International', 'International shipping', 15.00, 14, NOW(), NOW()),
('Local', 'Local delivery', 2.00, 1, NOW(), NOW()),
('Pickup', 'In-store pickup', 0.00, 0, NOW(), NOW()),
('Drone', 'Drone delivery', 30.00, 1, NOW(), NOW()),
('Economy', 'Economy shipping', 3.00, 10, NOW(), NOW()),
('Same-day', 'Same-day delivery', 25.00, 1, NOW(), NOW()),
('Weekend', 'Weekend delivery', 12.00, 2, NOW(), NOW());


INSERT INTO posts (name, created_at, updated_at)
VALUES
('Post1', NOW(), NOW()),
('Post2', NOW(), NOW()),
('Post3', NOW(), NOW()),
('Post4', NOW(), NOW()),
('Post5', NOW(), NOW()),
('Post6', NOW(), NOW()),
('Post7', NOW(), NOW()),
('Post8', NOW(), NOW()),
('Post9', NOW(), NOW()),
('Post10', NOW(), NOW());


INSERT INTO cities (name, country, created_at, updated_at)
VALUES
('City1', 'Morocco', NOW(), NOW()),
('City2', 'Morocco', NOW(), NOW()),
('City3', 'Morocco', NOW(), NOW()),
('City4', 'Morocco', NOW(), NOW()),
('City5', 'Morocco', NOW(), NOW()),
('City6', 'Morocco', NOW(), NOW()),
('City7', 'Morocco', NOW(), NOW()),
('City8', 'Morocco', NOW(), NOW()),
('City9', 'Morocco', NOW(), NOW()),
('City10', 'Morocco', NOW(), NOW());


INSERT INTO schools (name, city_id, created_at, updated_at)
VALUES
('School1', 1, NOW(), NOW()),
('School2', 2, NOW(), NOW()),
('School3', 3, NOW(), NOW()),
('School4', 4, NOW(), NOW()),
('School5', 5, NOW(), NOW()),
('School6', 6, NOW(), NOW()),
('School7', 7, NOW(), NOW()),
('School8', 8, NOW(), NOW()),
('School9', 9, NOW(), NOW()),
('School10', 10, NOW(), NOW());


INSERT INTO groups (name, school_id, school_list, created_at, updated_at)
VALUES
('Group1', 1, null, NOW(), NOW()),
('Group2', 2, null, NOW(), NOW()),
('Group3', 3, null, NOW(), NOW()),
('Group4', 4, null, NOW(), NOW()),
('Group5', 5, null, NOW(), NOW()),
('Group6', 6, null, NOW(), NOW()),
('Group7', 7, null, NOW(), NOW()),
('Group8', 8, null, NOW(), NOW()),
('Group9', 9, null, NOW(), NOW()),
('Group10', 10, null, NOW(), NOW());


INSERT INTO categories (name, created_at, updated_at)
VALUES
('Category1', NOW(), NOW()),
('Category2', NOW(), NOW()),
('Category3', NOW(), NOW()),
('Category4', NOW(), NOW()),
('Category5', NOW(), NOW()),
('Category6', NOW(), NOW()),
('Category7', NOW(), NOW()),
('Category8', NOW(), NOW()),
('Category9', NOW(), NOW()),
('Category10', NOW(), NOW());


INSERT INTO articles (name, description, type, price, status, category_id, created_at, updated_at)
VALUES
('Article1', 'Description1', 1, 10.00, 1, 1, NOW(), NOW()),
('Article2', 'Description2', 2, 20.00, 1, 2, NOW(), NOW()),
('Article3', 'Description3', 1, 30.00, 1, 3, NOW(), NOW()),
('Article4', 'Description4', 2, 40.00, 1, 4, NOW(), NOW()),
('Article5', 'Description5', 1, 50.00, 1, 5, NOW(), NOW()),
('Article6', 'Description6', 2, 60.00, 1, 6, NOW(), NOW()),
('Article7', 'Description7', 1, 70.00, 1, 7, NOW(), NOW()),
('Article8', 'Description8', 2, 80.00, 1, 8, NOW(), NOW()),
('Article9', 'Description9', 1, 90.00, 1, 9, NOW(), NOW()),
('Article10', 'Description10', 2, 100.00, 1, 10, NOW(), NOW());


INSERT INTO variants (article_id, color, image_id, status, created_at, updated_at)
VALUES
(1, 'Red', null, 1, NOW(), NOW()),
(2, 'Blue', null, 1, NOW(), NOW()),
(3, 'Green', null, 1, NOW(), NOW()),
(4, 'Yellow', null, 1, NOW(), NOW()),
(5, 'Black', null, 1, NOW(), NOW()),
(6, 'White', null, 1, NOW(), NOW()),
(7, 'Purple', null, 1, NOW(), NOW()),
(8, 'Orange', null, 1, NOW(), NOW()),
(9, 'Pink', null, 1, NOW(), NOW()),
(10, 'Brown', null, 1, NOW(), NOW());


INSERT INTO group_articles (group_id, article_id, quantity, created_at, updated_at)
VALUES
(1, 1, 1, NOW(), NOW()),
(2, 2, 2, NOW(), NOW()),
(3, 3, 3, NOW(), NOW()),
(4, 4, 4, NOW(), NOW()),
(5, 5, 5, NOW(), NOW()),
(6, 6, 6, NOW(), NOW()),
(7, 7, 7, NOW(), NOW()),
(8, 8, 8, NOW(), NOW()),
(9, 9, 9, NOW(), NOW()),
(10, 10, 10, NOW(), NOW());


INSERT INTO promo_codes (available_from, available_to, code, reduction_rate, created_at, updated_at)
VALUES
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE1', 0.1, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE2', 0.2, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE3', 0.3, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE4', 0.4, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE5', 0.5, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE6', 0.6, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE7', 0.7, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE8', 0.8, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE9', 0.9, NOW(), NOW()),
(NOW(), NOW() + INTERVAL 30 DAY, 'CODE10', 1.0, NOW(), NOW());


