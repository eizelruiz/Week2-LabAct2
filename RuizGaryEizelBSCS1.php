<?php

// Class representing a book
class Book {
    public $title;         // Public property
    protected $author;     // Protected property
    private $price;        // Private property

    // Constructor to initialize book properties
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    // Method to get the details of the book
    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}\n";
    }

    // Method to update the price of the book
    public function setPrice($price) {
        $this->price = $price;
    }

    // Magic method to handle calls to non-existent methods
    public function __call($name, $arguments) {
        if ($name == 'updateStock') {
            echo "Stock updated for '{$this->title}' with arguments: " . implode(', ', $arguments) . "\n";
        } else {
            echo "The method '$name' does not exist.\n";
        }
    }
}

// Class representing a library
class Library {
    public $name;          // Public property for library name
    private $books = [];   // Private array to store books

    // Constructor to initialize the library with a name
    public function __construct($name) {
        $this->name = $name;
        echo "Library '{$this->name}' created.\n";
    }

    // Method to add a book to the library
    public function addBook(Book $book) {
        $this->books[] = $book;
        echo "Book '{$book->title}' added to the library.\n";
    }

    // Method to remove a book by title
    public function removeBook($title) {
        foreach ($this->books as $key => $book) {
            if ($book->title === $title) {
                unset($this->books[$key]);
                echo "Book '$title' removed from the library.\n";
                return;
            }
        }
        echo "Book '$title' not found in the library.\n";
    }

    // Method to list all books in the library
    public function listBooks() {
        if (empty($this->books)) {
            echo "No books available in the library.\n";
        } else {
            foreach ($this->books as $book) {
                echo $book->getDetails();
            }
        }
    }

    // Destructor to clean up resources and display closing message
    public function __destruct() {
        echo "The library '{$this->name}' is now closed.\n";
    }
}

// Creating book instances
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 12.99);
$book2 = new Book("1984", "George Orwell", 8.99);

// Creating the library
$library = new Library("City Library");

// Adding books to the library
$library->addBook($book1);
$library->addBook($book2);

// Simulating stock update using non-existent method via __call
$book1->updateStock(50);

// Listing all books in the library
echo "\nBooks in the library:\n";
$library->listBooks();

// Removing a book by title
$library->removeBook("1984");

// Listing books after removal
echo "\nBooks in the library after removal:\n";
$library->listBooks();

// When the script ends, the destructor will be triggered
?>