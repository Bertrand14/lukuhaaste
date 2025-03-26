try {
    const PagesQuantity =
        document.getElementById("pages-number").dataset.quantity;
    const BooksQuantity =
        document.getElementById("books-number").dataset.quantity;
    const ReadersQuantity =
        document.getElementById("reader-number").dataset.quantity;
} catch (err) {
    console.log(err);
}
