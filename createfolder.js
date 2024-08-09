const fs = require('fs');

// Reading a file asynchronously
fs.readFile('path/to/file.txt', 'utf8', (err, data) => {
    if (err) {
        console.error('Error reading file:', err);
    } else {
        console.log('File content:', data);
    }
});

// Writing to a file asynchronously
fs.writeFile('path/to/file.txt', 'Hello, world!', (err) => {
    if (err) {
        console.error('Error writing file:', err);
    } else {
        console.log('File written successfully!');
    }
});

// Creating a directory asynchronously
fs.mkdir('path/to/new-directory', (err) => {
    if (err) {
        console.error('Error creating directory:', err);
    } else {
        console.log('Directory created successfully!');
    }
});
