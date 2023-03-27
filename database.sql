-- Create the bookshop database
CREATE DATABASE IF NOT EXISTS bookshop;

-- Switch to the bookshop database
USE bookshop;

-- Create the categories table
CREATE TABLE categories (
  category_id INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (category_id)
);

-- Insert initial category data
INSERT INTO categories (category_name) VALUES ('New Books');
INSERT INTO categories (category_name) VALUES ('Rental Books');

-- Create the books table
CREATE TABLE books (
  book_id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(100) NOT NULL,
  publisher VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  category_id INT(11) NOT NULL,
  PRIMARY KEY (book_id),
  FOREIGN KEY (category_id) REFERENCES categories (category_id)
);




ALTER TABLE books
ADD COLUMN genres VARCHAR(255);



-- Insert data into books table
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', 14.99, 1, 'Fiction, Classic');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott & Co.', 12.99, 1, 'Fiction, Classic');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', 9.99, 1, 'Fiction, Classic');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('1984', 'George Orwell', 'Secker & Warburg', 16.99, 1, 'Fiction, Dystopian');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('Pride and Prejudice', 'Jane Austen', 'T. Egerton, Whitehall', 8.99, 1, 'Fiction, Romance');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('The Lord of the Rings', 'J.R.R. Tolkien', 'Allen & Unwin', 24.99, 1, 'Fiction, Fantasy');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('The Da Vinci Code', 'Dan Brown', 'Doubleday', 13.99, 1, 'Fiction, Thriller');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('Gone with the Wind', 'Margaret Mitchell', 'Macmillan Publishers', 11.99, 2, 'Fiction, Historical');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('The Hunger Games', 'Suzanne Collins', 'Scholastic Corporation', 9.99, 2, 'Fiction, Dystopian');
INSERT INTO books (title, author, publisher, price, category_id, genres) VALUES ('Divergent', 'Veronica Roth', 'Katherine Tegen Books', 7.99, 2, 'Fiction, Dystopian');
