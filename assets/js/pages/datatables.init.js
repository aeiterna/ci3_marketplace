/*
Template Name: Lexa - Admin & Dashboard Template
Author: Themesdesign
Website: https://Themesdesign.com/
Contact: Themesdesign@gmail.com
File: Datatables
*/



$(document).ready(function() {
    // Initialize DataTable for the table with ID 'dataTable'
    $('#dataTable').DataTable({
        lengthChange: false, // Optional: Disable length change dropdown
        buttons: ['copy', 'excel', 'pdf', 'colvis'], // Optional: Add buttons
    });

    // Move the buttons container to a specific location in the DOM
    $('#dataTable').DataTable().buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

    // Optional: Add a class to the length selection dropdown for styling
    $(".dataTables_length select").addClass('form-select form-select-sm');
});
