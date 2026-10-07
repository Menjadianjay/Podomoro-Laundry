document.addEventListener("DOMContentLoaded", function () {
    const kehadiranSelect = document.getElementById("kehadiran");
    const keteranganGroup = document.getElementById("keterangan-group");

    // Debug: inspect the elements
    console.log(kehadiranSelect); // Should display the select element
    console.log(keteranganGroup); // Should display the notes group element

    function toggleKeterangan() {
        console.log("Attendance status:", kehadiranSelect.value); // Debug the dropdown value
        if (kehadiranSelect.value !== "Hadir") {
            keteranganGroup.style.display = "block";
        } else {
            keteranganGroup.style.display = "none";
        }
    }

    // Run the function when the page loads
    toggleKeterangan();

    // Add an event listener for selection changes
    kehadiranSelect.addEventListener("change", toggleKeterangan);
});
