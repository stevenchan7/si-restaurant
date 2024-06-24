// Navbar Hover
const navbar = document.getElementsByTagName('nav')[0];
window.addEventListener('scroll', function () {
    console.log(window.scrollY);
    if (window.scrollY > 1) {
        navbar.classList.replace('bg-transparent', 'nav-color')
    } else if (window.scrollY <= 0) {
        navbar.classList.replace('nav-color', 'bg-transparent')
    }
});

// Modal Preview
document.addEventListener("DOMContentLoaded", function () {
    const tables = document.querySelectorAll(".table-circle");

    tables.forEach(table => {
        table.addEventListener("click", function () {
            const number = this.getAttribute("data-number");
            const capacity = this.getAttribute("data-capacity");
            const status = this.getAttribute("data-status");

            document.getElementById("modalTableNumber").textContent = number;
            document.getElementById("modalCapacity").textContent = capacity;
            document.getElementById("modalStatus").textContent = status;

            var tableModal = new bootstrap.Modal(document.getElementById('tableModal'));
            tableModal.show();
        });

        table.addEventListener("mouseenter", function () {
            this.style.cursor = "pointer";
        });

        table.addEventListener("mouseleave", function () {
            this.style.cursor = "default";
        });
    });
});

let selectedTable = null;

document.querySelectorAll('.table-circle').forEach(function (table) {
    table.addEventListener('click', function () {
        // Reset previous selection if any

        // Set the new selected table
        selectedTable = this;
        this.style.backgroundColor = 'green'; // Highlight the selected table
        this.style.color = 'white'; // Highlight the selected table

        // Get data attributes
        var tableNumber = selectedTable.getAttribute('data-number');
        var capacity = selectedTable.getAttribute('data-capacity');
        var status = selectedTable.getAttribute('data-status');
        var id = selectedTable.getAttribute('data-id');

        // Set the form input values
        document.getElementById('table-number').value = tableNumber;
        document.getElementById('capacity').value = capacity;
        document.getElementById('status').value = status;
        document.getElementById('table-id').value = id;

    });
});

document.getElementById('book-table-button').addEventListener('click', function (event) {
    if (!selectedTable) {
        event.preventDefault();
        alert("Please select a table first.");
    }
});